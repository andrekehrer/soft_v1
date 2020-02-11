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

	public function divida_name_by_id($id){
		$data = $this->db->get_where('dividas', array('id' => $id))->result();
		$data = $data[0]->nome;
		// print_r($data[0]->nome); exit(0);
		return $data;
	}
	public function pagar_divida($id, $valor){

		$valor_atual = $this->db->get_where('dividas', array('id' => $id))->result();
		// print_r($valor_atual[0]->valor);exit(0);
		$valor_atual = $valor_atual[0]->valor;
		$valor_final = $valor_atual - $valor;
		$data = array( 
			'valor'  =>  $valor_final
		);
		$this->db->where('id', $id);
		$this->db->update('dividas', $data);
		if($this->db->affected_rows() == 1){
			$data['msg'] = 'Success';
		}else{
			$data['msg'] = 'Error';
		}
		return $data;
	}

	public function voltar_divida($nome, $valor){

		$valor_atual = $this->db->get_where('dividas', array('nome' => $nome))->result();
		// print_r($valor_atual[0]->valor);exit(0);
		$valor_atual = $valor_atual[0]->valor;
		$valor_final = $valor_atual + $valor;
		$data = array( 
			'valor'  =>  $valor_final
		);
		$this->db->where('nome', $nome);
		$this->db->update('dividas', $data);
		if($this->db->affected_rows() == 1){
			$data['msg'] = 'Success';
		}else{
			$data['msg'] = 'Error';
		}
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


