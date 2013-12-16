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
	* Fonction uniquement accessible par AJAX, elle récupère l'ensemble des films répondant aux critères de recherche
	* @return void
	*/
	public function search() {
		if($this->input->is_ajax_request()) {
			$this->load->model('Film_model','', TRUE);
			$post = $this->input->post();
			foreach($post as $key => &$value) {
				if($key !== 'genre' && trim($value) === '') {
					unset($$post[$key]);
				}
				else if($key === 'genre') {
					foreach($value as $genreKey => &$genreId) {
						if($genreId === '0') {
							unset($value[$genreKey]);
						}
					}
				}
			}
			$result = $this->Film_model->searchFilm($post);
			if($result){ 
				$data['allFilm'] = $result;
				$this->load->view('film_table',$data);
			}
			else {
				echo '<tr></tr>';
			}
		}
		else {
			show_404();
		}
	}
}

/* End of file film.php */
/* Location: ./application/controllers/film.php */