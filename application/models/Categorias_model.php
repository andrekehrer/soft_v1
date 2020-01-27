<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categorias_model extends CI_Model
{
	public function __construct()
    {
        parent::__construct();
    }

	public function index(){
		return;
	}



	public function get_all_cats(){
		return $this->db->get("categorias")->result();
	}
}


