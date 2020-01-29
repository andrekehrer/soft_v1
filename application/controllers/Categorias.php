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

	public function update_categoria(){
		$id = $_GET['id_edit'];
		$nome = $_GET['nome_edit'];
		//print_r($nome);exit(0);
		$data = array( 
			'nome'  =>  $nome
		);
		$this->db->where('cat_id', $id);
		$this->db->update('categorias', $data);
		if($this->db->affected_rows() == 1){
			$data['msg'] = 'Categoria editada com sucesso!';
		}else{
			$data['msg'] = 'Algo aconteceu e nao conseguimos salvar sua edicao. Tente novamente mais tarde!';
		}

		echo json_encode($data, true);
		//print_r($this->db->affected_rows());exit(0);
	}

	public function nova_categoria(){
		$nome = $_GET['nome_nova'];
		//print_r($nome);exit(0);
		$data = array( 
			'nome'   =>  $nome,
			'status' =>  1
		);
		$this->db->insert('categorias', $data);

		if($this->db->affected_rows() == 1){
			$data['msg'] = 'Categoria editada com sucesso!';
		}else{
			$data['msg'] = 'Algo aconteceu e nao conseguimos salvar sua edicao. Tente novamente mais tarde!';
		}

		echo json_encode($data, true);
		//print_r($this->db->affected_rows());exit(0);
	}

	public function carregar_tabela(){
		$data = $this->db->get("categorias")->result();	
		echo json_encode($data, true);
	}

	public function delete_categoria(){
		$id = $_GET['id'];

		$this->db->where('cat_id', $id);
		$this->db->delete('categorias');
		if($this->db->affected_rows() == 1){
			$data['msg'] = 1;
		}else{
			$data['msg'] = 0;
		}
	}
}