<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contas extends CI_Controller {

	public function index(){	
		$this->load->model('contas_model');
		$contas = $this->contas_model->get_all_contas();

		foreach ($contas as $cat) {

			$array_contas[] = [
				'id' => $cat->id,
				'nome' =>  $cat->nome,
				'saldo' =>  $cat->saldo,
				'cartao' => $cat->cartao,
			];
		}
		//echo "<pre>";print_r(count($categorias));exit(0);
		$data['data_contas'] = (isset($array_contas) ? $array_contas : 'No Register');
		//echo json_encode($json, true);
		$data['contas'] = count($contas);
		$data['menu'] = 'contas';
		$data['title'] = "Categorias - Meu Dinheiro";
		$this->load->view('pages/contas', $data);
	}
	public function contas_id($id){

		$this->load->model('contas_model');
		$contas = $this->contas_model->get_all_contas();

		foreach ($contas as $cat) {

			$array_contas[] = [
				'id' => $cat->id,
				'nome' =>  $cat->nome,
				'saldo' =>  $cat->saldo,
				'cartao' => $cat->cartao,
			];
		}
		//echo "<pre>";print_r(count($categorias));exit(0);
		$data['data_contas'] = (isset($array_contas) ? $array_contas : 'No Register');
		//echo json_encode($json, true);
		$data['contas'] = count($contas);
		
		$this->load->model('contas_model');
		$contas_ = $this->contas_model->get_conta_by_id($id);

		foreach ($contas_ as $cat) {

			$array_[] = [
				'id' => $cat->id,
				'nome' =>  $cat->desc,
				'saldo' =>  $cat->valor
			];
		}

		
		$nome_conta = $this->contas_model->get_nome_conta($id);
		$data['nome_conta'] = $nome_conta[0]->nome;
		$data['data_'] = (isset($array_) ? $array_ : 'No Register');
		//echo json_encode($json, true);
		$data['contas_'] = count($contas_);
		$data['menu'] = 'contas';
		$data['title'] = "Categorias - Meu Dinheiro";
		$this->load->view('pages/contas_individual', $data);

	}

	public function update_categoria(){
		$id = $_GET['id_edit'];
		$nome = $_GET['nome_edit'];
		$cor = $_GET['cor'];
		//print_r($nome);exit(0);
		$data = array( 
			'nome'  =>  $nome,
			'cor'   =>  $cor
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
		$cor = $_GET['cor_nova'];
		//print_r($nome);exit(0);
		$data = array( 
			'nome'   =>  $nome,
			'cor'    =>  $cor,
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