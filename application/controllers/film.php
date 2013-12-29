<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Film extends CI_Controller {

	/** 
	* Page d'accueil
	* Elle affiche la page listant les films et le formulaire de recherche
	* @return void
	*/
	public function index()
	{
		$this->load->model('Film_model','', TRUE);
		$data['allFilm'] = $this->Film_model->getAllFilm();

		$data['tableFilm'] = $this->load->view('film_table',$data,TRUE);

		$data['genre'] = $this->Film_model->getGenre();
		$this->load->view('film_index', $data);
	}

	/**
	* Fonction uniquement accessible via AJAX, elle récupère l'ensemble des films répondant aux critères de recherche
	* @return String
	*/
	public function search() {
		if($this->input->is_ajax_request()) {
			$this->load->model('Film_model','', TRUE);
			$post = $this->input->post();
			$post['couleur'] = array();
			foreach($post as $key => &$value) {
				if($key === 'genre') {
					foreach($value as $genreKey => &$genreId) {
						if($genreId === '0') {
							unset($post[$key]);
						}
					}
				}
				else if ($key === 'nb' || $key === 'both' || $key === 'color') {
					unset($post[$key]);
					array_push($post['couleur'],$value);
				}
				else if($key !== 'couleur' && trim($value) === '') {
					unset($post[$key]);
				}
			}
			if(empty($post['couleur'])){
				unset($post['couleur']);
			}
			$result = $this->Film_model->searchFilm($post);
			if($result){ 
				$data['allFilm'] = $result;
				$this->load->view('film_table',$data);
			}
			else {
				echo '<tr><td>Aucun résultat</td></tr>';
			}
		}
		else {
			show_404();
		}
	}

	/**
	* Fonction uniquement accessible via AJAX
	* Récupère la liste des réalisateurs correspondants (module d'autocomplétion)
	* @return JSON
	*/
	public function getReal(){
		if($this->input->is_ajax_request()) {
			$search = $this->input->post('term');
			$this->load->model('Film_model','', TRUE);
			$reals = $this->Film_model->getReal($search);
			if($reals) {
				echo json_encode($reals);
			}
		}
		else {
			show_404();
		}
	}

	public function infoFilm() {
		if($this->input->is_ajax_request()) {
			$this->load->model('Film_model', '', TRUE);
			$data['code_film'] = $this->input->post('id');
			$result = $this->Film_model->searchFilm($data);
			$film = $result[0];
			foreach($film as &$value) {
				$value = trim($value);
			}
			$total = count($result);
			if($total > 1) {
				for($i = 1; $i < $total; $i++ ) {
					$film->genre .= ', '.trim($result[$i]->genre);
				}
			}
			$data['film'] = $film;
			$this->load->view('film_info', $data);
		}
	}

	/**
	* Fonction générant le fichier XML en fonction du formulaire de XMLForm
	* Télécharge le fichier XML généré
	* @return void
	*/

	public function exportXML() {
		session_start();
		if($genre = $this->input->post('genre')) {
			$this->load->model('Film_model','',TRUE);
			$this->load->helper('file');
			$this->load->helper('download');

			$data['genre'] = $genre;
			$result = $this->Film_model->getFilmXML($data);
			$dom = new DomDocument('1.0','utf-8');
			$lastGenre = '';
			foreach($result as $film) {
				$currentGenre = $film->genre;
				if($currentGenre !== $lastGenre) {
					$genre = $dom->createElement('genre');
					$genreAttr = $dom->createAttribute('name');
					$genreAttr->value = $film->genre;
					$genre->appendChild($genreAttr);
					$lastGenre = $currentGenre;
				}

				// Parent
				$currentFilm = $dom->createElement('film');

				$real = $dom->createElement('realisateur', htmlentities($film->nom.' '.$film->prenom));
				$originalTitle = $dom->createElement('titreOriginal', htmlentities($film->titre_original));
				$frenchTitle = $dom->createElement('titreFrancais', htmlentities($film->titre_francais));
				$country = $dom->createElement('pays', htmlentities($film->pays));
				$release = $dom->createElement('date', htmlentities($film->date));
				$duration = $dom->createElement('duree', htmlentities($film->duree));
				$color = $dom->createElement('couleur', htmlentities($film->couleur));
				$currentFilm->appendChild($real);
				$currentFilm->appendChild($originalTitle);
				$currentFilm->appendChild($frenchTitle);
				$currentFilm->appendChild($country);
				$currentFilm->appendChild($release);
				$currentFilm->appendChild($duration);
				$currentFilm->appendChild($color);

				$genre->appendChild($currentFilm);

				$dom->appendChild($genre);
			}
			$file = $dom->saveXML();
			date_default_timezone_set('Europe/Paris');
			$time = date('d/m/Y_G:i:s');
			write_file('./assets/userfile/XML_export_'.session_id().'_'.$time, $file);
			force_download('Exportation XML.xml', $file);

		}
		else {

		}
	}
}

/* End of file film.php */
/* Location: ./application/controllers/film.php */