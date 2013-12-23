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
			$search = $this->input->post("term");
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

	/**
	* Fonction générant le fichier XML en fonction du formulaire de XMLForm
	* Télécharge le fichier XML généré
	* @return void
	*/

	public function exportXML() {
		if($post = $this->input->post()) {
			$dom = new DomDocument('1.0','utf-8');
			$film = $dom->createElement('film');
			$real = $dom->createElement('realiseur','Jean-Luc Godard');
			$film->appendChild($real);
			$dom->appendChild($film);
			echo $dom->saveXML();

		}
		else {

		}
	}

	public function test() {
		$this->load->model('Film_model','', TRUE);
		$data['allFilm'] = $this->Film_model->getAllFilm();

		$data['tableFilm'] = $this->load->view('table_test',$data,TRUE);

		$data['genre'] = $this->Film_model->getGenre();
		$this->load->view('test', $data);
	}
}

/* End of file film.php */
/* Location: ./application/controllers/film.php */