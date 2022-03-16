<?php
class modelDataset extends CI_Model
{
	var $table = 'dataset'; //nama tabel dari database
	var $column_order = array(null, 'id_data', 'kategori_lahan', 'rasio', 'kategori_air', 'tingkat_hidup', 'status_data', 'class', null); //Sesuaikan dengan field
	var $column_search = array('kategori_lahan', 'rasio', 'kategori_air', 'tingkat_hidup', 'status_data', 'class'); //field yang diizin untuk pencarian 
	var $order = array('kategori_lahan' => 'asc'); // default order 


	private function _get_datatables_query()
	{
		$email = $this->session->userdata('email');
		$level = $this->session->userdata('user_level');
		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		$id_user = $user['id_user'];
		if ($level == 1) {
			$this->db->from($this->table);
		} else {
			$this->db->from($this->table)->where(['id_user' => $id_user]);
		}
		$i = 0;

		foreach ($this->column_search as $item) // looping awal
		{
			if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
			{

				if ($i === 0) // looping awal
				{
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if (count($this->column_search) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}

		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered($id_user)
	{
		$level = $this->session->userdata('user_level');
		if ($level == 1) {
			$this->_get_datatables_query();
			$query = $this->db->get();
			return $query->num_rows();
		}
		$query = $this->db->get_where('dataset', ['id_user' => $id_user]);
		return $query->num_rows();
	}

	public function count_all($id_user)
	{
		$level = $this->session->userdata('user_level');
		if ($level == 1) {
			$this->db->from($this->table);
			return $this->db->count_all_results();
		}
		$this->db->from($this->table)->where(['id_user' => $id_user]);
		return $this->db->count_all_results();
	}
	public function datasetByUser($id_user)
	{
		$query = $this->db->get_where('dataset', ['id_user' => $id_user]);
		return $query->result();
	}
}
