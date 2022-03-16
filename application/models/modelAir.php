<?php
class modelAir extends CI_Model
{
	public function sumAir($idPrediksi)
	{
		$query = $this->db->query("SELECT SUM(kualitas) FROM air WHERE id_prediksi = $idPrediksi")->row();

		return $query;
	}
}
