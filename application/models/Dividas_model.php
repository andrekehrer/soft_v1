<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dividas_model extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
    }

	public function index(){
		return;
	}



	public function get_all_dividas(){
		//$this->db->order_by('categoria_id', 'ASC');
		$this->db->order_by('id', 'ASC');
		return $this->db->get("dividas")->result();
	}

	public function get_all_dividas_pagas(){
		$this->db->where('pagou', 1);
		return $this->db->get("dividas")->result();
	}

	public function get_cat_by_id($id){
		$data = $this->db->get_where('categorias', array('cat_id' => $id))->result();
		// print_r($data[0]->nome); exit(0);
		return $data;
	}

	public function get_all_dividas_apagar($data_query = null){
		if($data_query){
			$query_ = $this->db->query("SELECT * FROM dividas WHERE pagou = 0 and data = $data_query");
			$data = $query_->result();

		}else{	
			$query = $this->db->query('SELECT * FROM dividas WHERE pagou = 0');
			$data = $query->num_rows();
		}
		return $data;
	}
}


