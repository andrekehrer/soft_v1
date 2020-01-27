<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{	
		$this->load->model('entradas_model');

		$data['total_mes'] = $this->entradas_model->get_all_entradas();
		$data['title'] = "Dashboard - Meu Dinheiro";
		$this->load->view('pages/dashboard', $data);
	}
}