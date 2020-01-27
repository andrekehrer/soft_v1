<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {

	public function index(){	
		$this->load->model('categorias_model');
		$categorias = $this->categorias_model->get_all_cats();

		foreach ($categorias as $cat) {

			$array[] = [
				'id' => $cat->cat_id,
				'nome' =>  $cat->nome,
				'status' => $cat->status,
			];
		}
		//echo "<pre>";print_r($array);exit(0);
		$data['data'] = (isset($array) ? $array : 'No Register');
		//echo json_encode($json, true);

		$data['title'] = "Categorias - Meu Dinheiro";
		$this->load->view('pages/categorias', $data);
	}
}