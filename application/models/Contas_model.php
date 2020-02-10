<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contas_model extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
    }

	public function index(){
		return;
	}



	public function get_all_contas(){
		//$this->db->order_by('categoria_id', 'ASC');
		$this->db->order_by('id', 'ASC');
		return $this->db->get("contas")->result();
	}

	public function get_conta_by_id($id = null){
		$data = $this->db->get_where('saidas_v', array('conta' => $id))->result();
		// print_r($data[0]->nome); exit(0);
		return $data;
	}

		public function get_nome_conta($id = null){
		$data = $this->db->get_where('contas', array('id' => $id))->result();
		// print_r($data[0]->nome); exit(0);
		return $data;
	}
}


