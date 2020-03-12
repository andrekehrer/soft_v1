<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Saidas_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		return;
	}



	public function get_all_saidas()
	{
		$mes = date('m');
		//$this->db->order_by('categoria_id', 'ASC');
		$this->db->where('user_id', $_SESSION['backend']['userid']);
		$this->db->where('MONTH(data_full)', $mes);
		$this->db->order_by('data', 'ASC');
		return $this->db->get("saidas")->result();
		// print_r($this->db->last_query());
		// exit(0);
	}

	public function get_all_saidas_pagas()
	{
		$mes = date('m');
		$this->db->where('user_id', $_SESSION['backend']['userid']);
		$this->db->where('MONTH(data_full)', $mes);
		$this->db->where('pagou', 1);
		return $this->db->get("saidas")->result();
	}

	public function get_cat_by_id($id)
	{
		$data = $this->db->get_where('categorias', array('id' => $id, 'user_id' => $_SESSION['backend']['userid']))->result();
		// print_r($data[0]->nome); exit(0);
		return $data;
	}

	public function get_all_saidas_apagar($data_query = null)
	{
		$mes = date('m');
		if ($data_query) {
			$query_ = $this->db->query("SELECT * FROM saidas 
																WHERE pagou = 0 
																and MONTH(data_full) = $mes
																and data = $data_query 
																and user_id = " . $_SESSION['backend']['userid'] . "");
			$data = $query_->result();
		} else {
			$query = $this->db->query("SELECT * FROM saidas 
																WHERE pagou = 0 
																and MONTH(data_full) = $mes
																and user_id = " . $_SESSION['backend']['userid'] . "");
			$data = $query->num_rows();
		}
		// print_r($this->db->last_query());
		// exit(0);
		return $data;
	}
}
