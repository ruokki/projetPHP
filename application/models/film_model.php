<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Film_model extends CI_Model {

	/**
	* Récupère tout les films
	* @return object
	*/
	public function getAllFilm() {
		$query = $this->db->select('code_film AS id, titre_original, titre_francais, pays, date, duree, couleur, nom, prenom')
						   ->from('films')
						   ->join('individus','individus.code_indiv = films.realisateur')
						   ->get();
		if($query->num_rows() > 0) return $query->result();
		else return FALSE;
	}

	/**
	* Récupère tout les genres
	* @return object
	*/
	public function getGenre() {
		$query = $this->db->select()->from('genres')->get();
		if($query->num_rows() > 0) return $query->result();
		else return FALSE;
	}

	/**
	* Récupère les films correspondants aux critères de recherches
	* @return object
	*/
	public function searchFilm($data) {
		$this->db->select('code_film AS id, titre_original, titre_francais, pays, date, duree, couleur, nom, prenom, nom_genre AS genre')
						   ->distinct()
						   ->from('films')
						   ->join('classification', 'films.code_film = classification.ref_code_film')
						   ->join('genres', 'genres.code_genre = classification.ref_code_genre')
						   ->join('individus','individus.code_indiv = films.realisateur');
	   	foreach($data as $key => $value) {
	   		if($key === 'genre') {
	   			foreach($value as $genre) {
	   				$this->db->or_where('ref_code_genre',$genre);
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

	/**
	* Récupère les films groupés par catégorie
	* @return object
	*/
	public function getFilmXML($data) {
			$this->db->select('code_film AS id, titre_original, titre_francais, pays, date, duree, couleur, nom, prenom, nom_genre AS genre')
							   ->distinct()
							   ->from('films')
							   ->order_by('genre')
							   ->join('classification', 'films.code_film = classification.ref_code_film')
							   ->join('genres', 'genres.code_genre = classification.ref_code_genre')
							   ->join('individus','individus.code_indiv = films.realisateur');
		   	foreach($data as $key => $value) {
	   			foreach($value as $genre) {
	   				$this->db->or_where('ref_code_genre',$genre);
	   			}
		   	}
		   	$query = $this->db->get();
			if($query->num_rows() > 0) return $query->result();
			else return FALSE;
	}

}

/* End of file film_model.php */
/* Location: ./application/models/film_model.php */