<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{	
		$this->load->model('entradas_model');
		$this->load->model('saidas_model');
		$this->load->model('categorias_model');

		$this->load->model('saidas_model_v');

		$data['saidas_diarias'] = $this->saidas_model_v->get_all_saidas();
		$data['categorias'] = $this->categorias_model->get_all_cats();
		$data['total_des_fixa'] = $this->saidas_model->get_all_saidas_pagas();
		$data['total_mes'] = $this->entradas_model->get_all_entradas();
		$data['title'] = "Dashboard - Meu Dinheiro";
		$this->load->view('pages/dashboard', $data);
	}
}