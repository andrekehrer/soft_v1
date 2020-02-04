<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{	
		$this->load->model('entradas_model');
		$this->load->model('saidas_model');
		$this->load->model('categorias_model');
		$this->load->model('saidas_model_v');

		
		$data['total_bill'] = $this->saidas_model->get_all_saidas_apagar();
		$data['categorias'] = $this->categorias_model->get_all_cats();
		$data['total_des_fixa'] = $this->saidas_model->get_all_saidas_pagas();
		





		//$saidas_diarias = $this->saidas_model_v->get_all_saidas();
		$total_mes = $this->entradas_model->get_all_entradas();

		$total_mes_total = 0;
        foreach ($total_mes as $key => $value) {
          $total_mes_total = $total_mes_total + $value->valor;
        }
        $total_mes = '£'.number_format($total_mes_total, 2, ',', '.');


        echo "<pre>";print_r($total_mes);exit(0);



        $data['total_mes'] = $total_mes;                          
		$data['saidas_diarias'] = $this->saidas_model_v->get_all_saidas();
		$data['title'] = "Dashboard - Meu Dinheiro";
		$this->load->view('pages/dashboard', $data);
	}
}