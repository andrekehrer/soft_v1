<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Saidas_model_v extends CI_Model
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
		$this->db->select('*');
		$this->db->from('saidas_v');
		$this->db->join('contas', 'contas.id = saidas_v.conta');
		$this->db->order_by('data', 'DESC');
		$mes_corrente = date('m');
		$this->db->where('saidas_v.user_id', $_SESSION['backend']['userid']);
		$this->db->where('MONTH(data)', $mes_corrente)->order_by('data', 'DESC');
		$query = $this->db->get()->result();
		return $query;
	}

	public function get_cat_by_id($id)
	{
		$data = $this->db->get_where('categorias', array('cat_id' => $id, 'user_id' => $_SESSION['backend']['userid']))->result();
		// print_r($data[0]->nome); exit(0);
		return $data;
	}

	public function get_saidas_v_by_id($id)
	{
		$data = $this->db->get_where('saidas_v', array('id' => $id, 'user_id' => $_SESSION['backend']['userid']))->result();
		// print_r($data[0]->nome); exit(0);
		return $data;
	}
}
