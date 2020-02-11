<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Saidas_model_v extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
    }

	public function index(){
		return;
	}



	public function get_all_saidas(){
		$this->db->order_by('data', 'ASC');
		return $this->db->get("saidas_v")->result();
	}

	public function get_cat_by_id($id){
		$data = $this->db->get_where('categorias', array('cat_id' => $id))->result();
		// print_r($data[0]->nome); exit(0);
		return $data;
	}

	public function get_saidas_v_by_id($id){
		$data = $this->db->get_where('saidas_v', array('id' => $id))->result();
		// print_r($data[0]->nome); exit(0);
		return $data;
	}
}


