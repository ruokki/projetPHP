<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Film_model extends CI_Model {

	public function getAllFilm() {
		$result = $this->db->select('code_film as id, titre_original, titre_francais, pays, date, duree, couleur, nom, prenom')->from('films')->join('individus','individus.code_indiv = films.realisateur')->get();
		if($result->num_rows() > 0) return $result->result();
		else return FALSE;
	}

}

/* End of file film_model.php */
/* Location: ./application/models/film_model.php */