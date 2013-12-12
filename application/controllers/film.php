<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Film extends CI_Controller {


	public function index()
	{
		$this->load->model('Film_model','', TRUE);
		$data['allFilm'] = $this->Film_model->getAllFilm();
		$data['genre'] = $this->Film_model->getGenre();
		$this->load->view('film_index', $data);
	}

	public function search() {
		if($this->input->is_ajax_request()) {
			$this->load->model('Film_model','', TRUE);
			$post = $this->input->post();
			foreach($post as $key => &$value) {
				if($key !== 'genre' && trim($value) === '') {
					unset($value);
				}
			}
			var_dump($post);
			
		}
		else {
			show_404();
		}
	}
}

/* End of file film.php */
/* Location: ./application/controllers/film.php */