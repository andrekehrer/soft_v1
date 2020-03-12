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
		$this->db->where('user_id', $_SESSION['backend']['userid']);
		if ($id) {
			$this->db->where('cartao', 1);
		}
		$this->db->order_by('nome', 'ASC');
		return $this->db->get("contas")->result();
	}
	public function get_contaid_by_id($id = null)
	{
		$data = $this->db->order_by('id', 'ASC')->get_where('contas', array('id' => $id, 'user_id' => $_SESSION['backend']['userid']))->result();
		// print_r($data[0]->nome); exit(0);
		return $data;
	}
	public function get_conta_by_id($id = null)
	{
		$mes = date('m');
		$data = $this->db->order_by('id', 'ASC')->get_where('saidas_v', array('MONTH(data)' => $mes, 'conta' => $id, 'user_id' => $_SESSION['backend']['userid']))->result();
		// $data =	$this->db->select('*')->from('saidas_v')
		// 	->group_start()
		// 	->where('conta', $id)
		// 	->or_group_start()
		// 	->where('pagou_cartao', $id)
		// 	->group_end()
		// 	->group_end()
		// 	->get()
		// 	->result();
		print_r($this->db->last_query());
		return $data;
	}
	public function get_conta_entrada_by_id($id = null)
	{
		$data = $this->db->order_by('id', 'ASC')->get_where('entradas', array('conta' => $id, 'user_id' => $_SESSION['backend']['userid']))->result();
		// print_r($data[0]->nome); exit(0);
		return $data;
	}
	public function get_entrada_cc_by_id($id = null)
	{
		$data = $this->db->order_by('id', 'ASC')->get_where('saidas_v', array('pagou_cartao' => $id, 'user_id' => $_SESSION['backend']['userid']))->result();
		// print_r($data[0]->nome); exit(0);
		return $data;
	}
	public function get_conta_saidas_fixas_by_id($id = null)
	{
		$data = $this->db->order_by('id', 'ASC')->get_where('saidas', array('conta' => $id, 'user_id' => $_SESSION['backend']['userid']))->result();
		// print_r($data[0]->nome); exit(0);
		return $data;
	}

	public function get_nome_conta($id = null)
	{
		$data = $this->db->get_where('contas', array('id' => $id, 'user_id' => $_SESSION['backend']['userid']))->result();
		// print_r($data[0]->nome); exit(0);
		return $data;
	}
	public function get_limite_contas_by_id($id = null)
	{
		$data = $this->db->get_where('contas', array('id' => $id, 'cartao' => 1, 'user_id' => $_SESSION['backend']['userid']))->result();
		$data = $data[0]->limite;
		//print_r($data[0]->saldo); exit(0);
		return $data;
	}
	public function get_saldo_contas_by_id($id = null)
	{
		$data = $this->db->get_where('contas', array('id' => $id, 'user_id' => $_SESSION['backend']['userid']))->result();
		$data = $data[0]->saldo;
		//print_r($data[0]->saldo); exit(0);
		return $data;
	}
	public function get_type_conta_by_id($id = null)
	{
		$data = $this->db->get_where('contas', array('id' => $id, 'user_id' => $_SESSION['backend']['userid']))->result();
		$data = $data[0]->cartao;
		//print_r($data[0]->saldo); exit(0);
		return $data;
	}
	public function atualizar_saldo($id = null, $valor = null)
	{
		$data = array(
			'saldo'  =>  $valor
		);
		$this->db->where('user_id', $_SESSION['backend']['userid']);
		$this->db->where('id', $id);
		$this->db->update('contas', $data);
		if ($this->db->affected_rows() == 1) {
			$data['msg'] = 'Success';
		} else {
			$data['msg'] = 'Error';
		}
		return $data;
	}

	public function get_conta_negativo()
	{
		$data = $this->db->get_where('contas', array('cartao' => 0, 'user_id' => $_SESSION['backend']['userid']))->result();
		return $data;
	}
}
