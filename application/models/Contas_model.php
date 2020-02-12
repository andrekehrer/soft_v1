<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contas_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get_all_contas($id = null)
	{
		//$this->db->order_by('categoria_id', 'ASC');
		if ($id) {
			$this->db->where('cartao', 1);
		}
		$this->db->order_by('id', 'ASC');
		return $this->db->get("contas")->result();
	}

	public function get_conta_by_id($id = null)
	{
		$data = $this->db->order_by('id', 'ASC')->get_where('saidas_v', array('conta' => $id))->result();
		// print_r($data[0]->nome); exit(0);
		return $data;
	}
	public function get_conta_entrada_by_id($id = null)
	{
		$data = $this->db->order_by('id', 'ASC')->get_where('entradas', array('conta' => $id))->result();
		// print_r($data[0]->nome); exit(0);
		return $data;
	}

	public function get_conta_saidas_fixas_by_id($id = null)
	{
		$data = $this->db->order_by('id', 'ASC')->get_where('saidas', array('conta' => $id))->result();
		// print_r($data[0]->nome); exit(0);
		return $data;
	}

	public function get_nome_conta($id = null)
	{
		$data = $this->db->get_where('contas', array('id' => $id))->result();
		// print_r($data[0]->nome); exit(0);
		return $data;
	}
	public function get_saldo_contas_by_id($id = null)
	{
		$data = $this->db->get_where('contas', array('id' => $id))->result();
		$data = $data[0]->saldo;
		//print_r($data[0]->saldo); exit(0);
		return $data;
	}
	public function get_type_conta_by_id($id = null)
	{
		$data = $this->db->get_where('contas', array('id' => $id))->result();
		$data = $data[0]->cartao;
		//print_r($data[0]->saldo); exit(0);
		return $data;
	}
	public function atualizar_saldo($id = null, $valor = null)
	{
		$data = array(
			'saldo'  =>  $valor
		);
		$this->db->where('id', $id);
		$this->db->update('contas', $data);
		if ($this->db->affected_rows() == 1) {
			$data['msg'] = 'Success';
		} else {
			$data['msg'] = 'Error';
		}
		return $data;
	}
}
