<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Entradas_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		return;
	}

	public function get_all_entradas()
	{
		$mes_corrente = date('m');
		$this->db->where('MONTH(data)', $mes_corrente);
		return $this->db->get("entradas")->result();
	}
}
