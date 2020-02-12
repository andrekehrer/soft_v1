<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contas extends CI_Controller
{

	public function index()
	{
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
	public function contas_id($id)
	{
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
		$data['contas'] = count($contas);

		$this->load->model('contas_model');
		$contas_ = $this->contas_model->get_conta_by_id($id);

		foreach ($contas_ as $cat) {
			$contas_todas[] = [
				'id' => $cat->id,
				'nome' =>  $cat->nome,
				'saldo' =>  $cat->saldo
			];
		}

		$contas_entradas = $this->contas_model->get_conta_entrada_by_id($id);

		foreach ($contas_entradas as $ent) {
			$contas_todas_entradas[] = [
				'id' => $ent->id,
				'nome' =>  $ent->desc,
				'saldo' =>  $ent->valor,
				'date' =>  $ent->data
			];
		}
		$contas_saidas_fixas = $this->contas_model->get_conta_saidas_fixas_by_id($id);

		foreach ($contas_saidas_fixas as $ent) {
			$contas_saidas_fi[] = [
				'id' => $ent->id,
				'nome' =>  $ent->desc,
				'saldo' =>  $ent->valor,
				'date' =>  $ent->data_full
			];
		}

		$nome_conta = $this->contas_model->get_nome_conta($id);
		$data['nome_conta'] = $nome_conta[0]->nome;
		$data['data_'] = (isset($contas_todas) ? $contas_todas : 'No Register');
		$data['data_entrada'] = (isset($contas_todas_entradas) ? $contas_todas_entradas : 'No Register');
		$data['data_saidas_fixas'] = (isset($contas_saidas_fi) ? $contas_saidas_fi : 'No Register');
		//echo json_encode($json, true);
		$data['contas_'] = count($contas_);
		$data['menu'] = 'contas';
		$data['title'] = "Categorias - Meu Dinheiro";
		$this->load->view('pages/contas_individual', $data);
	}

	public function novo_cartao()
	{
		$nome = $_GET['nome_nova'];
		$saldo = $_GET['saldo'];
		$cartao = $_GET['cartao'];
		//print_r($nome);exit(0);
		$data = array(
			'nome'   =>  $nome,
			'saldo'  =>  $saldo,
			'cartao' =>  $cartao
		);
		$this->db->insert('contas', $data);

		if ($this->db->affected_rows() == 1) {
			$data['msg'] = 'Categoria editada com sucesso!';
		} else {
			$data['msg'] = 'Algo aconteceu e nao conseguimos salvar sua edicao. Tente novamente mais tarde!';
		}

		echo json_encode($data, true);
		//print_r($this->db->affected_rows());exit(0);
	}
}
