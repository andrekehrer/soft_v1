<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Categorias extends CI_Controller
{

	public function index()
	{
		$this->load->model('contas_model');
		$contas = $this->contas_model->get_all_contas();
		foreach ($contas as $cat) {
			$array_conta[] = [
				'id' => $cat->id,
				'nome' =>  $cat->nome,
				'saldo' =>  $cat->saldo,
				'cartao' => $cat->cartao,
			];
		}
		$data['data_contas'] = (isset($array_conta) ? $array_conta : 'No Register');
		$data['contas'] = count($contas);

		$this->load->model('categorias_model');
		$categorias = $this->categorias_model->get_all_cats();

		foreach ($categorias as $cat) {

			$array[] = [
				'id' => $cat->id,
				'nome' =>  $cat->nome,
				'cor' =>  $cat->cor,
				'status' => $cat->status,
			];
		}
		$data['categorias_count'] = count($this->categorias_model->get_all_cats());
		$data['data'] = (isset($array) ? $array : 'No Register');
		$data['menu'] = 'categorias';
		$data['title'] = "Categorias - Meu Dinheiro";
		$this->load->view('pages/categorias', $data);
	}

	public function update_categoria()
	{
		$id = $_GET['id_edit'];
		$nome = $_GET['nome_edit'];
		$cor = $_GET['cor'];
		//print_r($nome);exit(0);
		$data = array(
			'nome'  =>  $nome,
			'cor'   =>  $cor
		);
		$this->db->where('user_id', $_SESSION['backend']['userid']);
		$this->db->where('id', $id);
		$this->db->update('categorias', $data);
		if ($this->db->affected_rows() == 1) {
			$data['msg'] = 'Categoria editada com sucesso!';
		} else {
			$data['msg'] = 'Algo aconteceu e nao conseguimos salvar sua edicao. Tente novamente mais tarde!';
		}

		echo json_encode($data, true);
		//print_r($this->db->affected_rows());exit(0);
	}

	public function nova_categoria()
	{
		$nome = $_GET['nome_nova'];
		$cor = $_GET['cor_nova'];
		//print_r($nome);exit(0);
		$data = array(
			'nome'   =>  $nome,
			'cor'    =>  $cor,
			'status' =>  1,
			'user_id' => $_SESSION['backend']['userid']
		);
		$this->db->insert('categorias', $data);

		if ($this->db->affected_rows() == 1) {
			$data['msg'] = 'Categoria editada com sucesso!';
		} else {
			$data['msg'] = 'Algo aconteceu e nao conseguimos salvar sua edicao. Tente novamente mais tarde!';
		}

		echo json_encode($data, true);
		//print_r($this->db->affected_rows());exit(0);
	}

	public function carregar_tabela()
	{
		$data = $this->db->get("categorias")->result();
		echo json_encode($data, true);
	}

	public function delete_categoria()
	{
		$id = $_GET['id'];
		$this->db->where('user_id', $_SESSION['backend']['userid']);
		$this->db->where('id', $id);
		$this->db->delete('categorias');
		if ($this->db->affected_rows() == 1) {
			$data['msg'] = 1;
		} else {
			$data['msg'] = 0;
		}
	}
}
