<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Saidas_model extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
    }

	public function index(){
		return;
	}



	public function get_all_saidas(){
		//$this->db->order_by('categoria_id', 'ASC');
		$this->db->order_by('data', 'ASC');
		return $this->db->get("saidas")->result();
	}

	public function get_all_saidas_pagas(){
		$this->db->where('pagou', 1);
		return $this->db->get("saidas")->result();
	}

	public function get_cat_by_id($id){
		$data = $this->db->get_where('categorias', array('cat_id' => $id))->result();
		// print_r($data[0]->nome); exit(0);
		return $data;
	}

	public function get_all_saidas_apagar($data_query = null){
		if($data_query){
			$query_ = $this->db->query("SELECT * FROM saidas WHERE pagou = 0 and data = $data_query");
			$data = $query_->result();

		}else{	
			$query = $this->db->query('SELECT * FROM saidas WHERE pagou = 0');
			$data = $query->num_rows();
		}
		return $data;
	}
}


