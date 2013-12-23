<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Film_model extends CI_Model {

	public function getAllFilm() {
		$query = $this->db->select('code_film as id, titre_original, titre_francais, pays, date, duree, couleur, nom, prenom')
						   ->from('films')
						   ->join('individus','individus.code_indiv = films.realisateur')
						   ->get();
		if($query->num_rows() > 0) return $query->result();
		else return FALSE;
	}

	public function getGenre() {
		$query = $this->db->select()->from('genres')->get();
		if($query->num_rows() > 0) return $query->result();
		else return FALSE;
	}

	public function getReal($nom) {
		$query = $this->db->select('nom')
						  ->distinct()
						  ->from('films')
						  ->join('individus', 'individus.code_indiv = films.realisateur')
						  ->like('nom', $nom, 'after')
						  ->get();
	    if($query->num_rows() > 0) return $query->result();
	    else return FALSE;
	}

	public function searchFilm($data) {
		$this->db->select('code_film as id, titre_original, titre_francais, pays, date, duree, couleur, nom, prenom')
						   ->distinct()
						   ->from('films')
						   ->join('classification', 'films.code_film = classification.ref_code_film')
						   ->join('individus','individus.code_indiv = films.realisateur');
	   	foreach($data as $key => $value) {
	   		if($key === 'genre') {
	   			foreach($value as $genre) {
	   				$this->db->where('ref_code_genre',$genre);
	   			}
	   		}
	   		else if ($key === 'realisateur') {
	   			$this->db->like('individus.nom', $value, 'after');
	   		}
	   		else if ($key === 'couleur') {
	   			foreach($value as $couleur) {
	   				$this->db->where('couleur',$couleur);
	   			}
	   		}
	   		else {
	   			$this->db->where($key,$value);
	   		}
	   	}
	   	$query = $this->db->get();
		if($query->num_rows() > 0) return $query->result();
		else return FALSE;
	}

}

/* End of file film_model.php */
/* Location: ./application/models/film_model.php */