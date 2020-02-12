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
		return $this->db->get("entradas")->result();
	}
}
