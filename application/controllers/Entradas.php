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

	public function update_entrada(){
		$id = $_GET['id_edit'];
		$nome = $_GET['nome_edit'];
		$valor = $_GET['valor_edit'];
		//print_r($nome);exit(0);
		$data = array( 
			'desc'  =>  $nome,
			'valor' =>  $valor
		);
		$this->db->where('cat_id', $id);
		$this->db->update('entradas', $data);
		if($this->db->affected_rows() == 1){
			$data['msg'] = 'Categoria editada com sucesso!';
		}else{
			$data['msg'] = 'Algo aconteceu e nao conseguimos salvar sua edicao. Tente novamente mais tarde!';
		}

		echo json_encode($data, true);
		//print_r($this->db->affected_rows());exit(0);
	}

	public function nova_entrada(){
		$nome = $_GET['nome_nova'];
		$valor = $_GET['valor_nova'];
		//print_r($nome);exit(0);
		$data = array( 
			'desc'   =>  $nome,
			'valor' =>  $valor
		);
		$this->db->insert('entradas', $data);

		if($this->db->affected_rows() == 1){
			$data['msg'] = 'Categoria editada com sucesso!';
		}else{
			$data['msg'] = 'Algo aconteceu e nao conseguimos salvar sua edicao. Tente novamente mais tarde!';
		}

		echo json_encode($data, true);
		//print_r($this->db->affected_rows());exit(0);
	}
}