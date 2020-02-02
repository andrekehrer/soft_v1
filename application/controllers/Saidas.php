<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Saidas extends CI_Controller {

	public function index(){	
		$this->load->model('saidas_model');
		$this->load->model('categorias_model');
		$categorias = $this->saidas_model->get_all_saidas();

		foreach ($categorias as $cat) {

			$array[] = [
				'id' => $cat->id,
				'nome' =>  $cat->desc,
				'valor' => $cat->valor,
				'categoria' => $this->saidas_model->get_cat_by_id($cat->categoria_id),
				'data' => $cat->data,
				'pagou' => $cat->pagou,
			];
		}


		$data['categorias'] = $this->categorias_model->get_all_cats();
		//echo "<pre>";print_r($array);exit(0);
		$data['data'] = (isset($array) ? $array : 'No Register');
		//echo json_encode($json, true);	
		$data['title'] = "Saidas - Meu Dinheiro";
		$this->load->view('pages/saidas', $data);
	}

	public function update_saida(){
		$id = $_GET['id_edit'];
		$nome = $_GET['nome_edit'];
		$valor = $_GET['valor_edit'];
		$data_mes = $_GET['data_mes'];
		$cat_id = $_GET['categoria'];

		$data = array( 
			'desc'  =>  $nome,
			'valor' =>  $valor,
			'data' =>  $data_mes,
			'categoria_id' =>  $cat_id
		);
		$this->db->where('id', $id);
		$this->db->update('saidas', $data);
		if($this->db->affected_rows() == 1){
			$data['msg'] = 'Categoria editada com sucesso!';
		}else{
			$data['msg'] = 'Algo aconteceu e nao conseguimos salvar sua edicao. Tente novamente mais tarde!';
		}

		echo json_encode($data, true);
		//print_r($this->db->affected_rows());exit(0);
	}

	public function nova_saida(){
		$nome = $_GET['nome_nova'];
		$categoria = $_GET['categoria'];
		$data_ = $_GET['data_mes'];
		$valor = $_GET['valor_nova'];


		//print_r($nome);exit(0);
		$data = array( 
			'desc'   =>  $nome,
			'valor' =>  $valor,
			'data' =>  $data_,
			'categoria_id' =>  $categoria
		);
		$this->db->insert('saidas', $data);

		if($this->db->affected_rows() == 1){
			$data['msg'] = 'Categoria editada com sucesso!';
		}else{
			$data['msg'] = 'Algo aconteceu e nao conseguimos salvar sua edicao. Tente novamente mais tarde!';
		}

		echo json_encode($data, true);
		//print_r($this->db->affected_rows());exit(0);
	}

	public function delete_saida(){
		$id = $_GET['id'];

		$this->db->where('id', $id);
		$this->db->delete('saidas');
		if($this->db->affected_rows() == 1){
			$data['msg'] = 1;
		}else{
			$data['msg'] = 0;
		}
	}

	public function pagar(){
		$id = $_GET['id'];
		$data = array( 
			'pagou'   =>  1
		);

		$this->db->where('id', $id);
		$this->db->update('saidas', $data);
		if($this->db->affected_rows() == 1){
			$data['msg'] = 1;
		}else{
			$data['msg'] = 0;
		}
	}
		public function despagar(){
		$id = $_GET['id'];
		$data = array( 
			'pagou'   =>  0
		);

		$this->db->where('id', $id);
		$this->db->update('saidas', $data);
		if($this->db->affected_rows() == 1){
			$data['msg'] = 1;
		}else{
			$data['msg'] = 0;
		}
	}



}