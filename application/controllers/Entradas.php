<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entradas extends CI_Controller {

	public function index(){	
		$this->load->model('entradas_model');
		$categorias = $this->entradas_model->get_all_entradas();

		foreach ($categorias as $cat) {

			$array[] = [
				'id' => $cat->id,
				'nome' =>  $cat->desc,
				'valor' => $cat->valor,
			];
		}
		//echo "<pre>";print_r($array);exit(0);
		$data['data'] = (isset($array) ? $array : 'No Register');
		//echo json_encode($json, true);	
		$data['title'] = "Entradas - Meu Dinheiro";
		$this->load->view('pages/entradas', $data);
	}
}