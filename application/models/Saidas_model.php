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
		$this->db->order_by('categoria_id', 'ASC');
		return $this->db->get("saidas")->result();
	}

	public function get_cat_by_id($id){
		$data = $this->db->get_where('categorias', array('cat_id' => $id))->result();
		// print_r($data[0]->nome); exit(0);
		return $data;
	}
}


