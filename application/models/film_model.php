<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Film_model extends CI_Model {

	public function getAllFilm() {
		$result = $this->db->select('code_film as id, titre_original, titre_francais, pays, date, duree, couleur, nom, prenom')
						   ->from('films')
						   ->join('individus','individus.code_indiv = films.realisateur')
						   ->get();
		if($result->num_rows() > 0) return $result->result();
		else return FALSE;
	}

	public function getGenre() {
		$result = $this->db->select()->from('genres')->get();
		if($result->num_rows() > 0) return $result->result();
		else return FALSE;
	}

	public function searchFilm($data) {
		$this->db->select('code_film as id, titre_original, titre_francais, pays, date, duree, couleur, nom, prenom')
						   ->from('films')
						   ->join('individus','individus.code_indiv = films.realisateur');
	   	foreach($data as $key => $value) {
	   		if($key === 'genre') {
	   			foreach($value as $genre) {
	   				$this->db->where('genre',$genre);
	   			}
	   		}
	   		else if ($key === 'realisateur') {
	   			$this->db->like();
	   		}
	   		else {
	   			$this->db->where($value)
	   		}
	   	}
		if($result->num_rows() > 0) return $result->result();
		else return FALSE;
	}

}

/* End of file film_model.php */
/* Location: ./application/models/film_model.php */