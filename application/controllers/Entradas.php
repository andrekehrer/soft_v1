<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Entradas extends CI_Controller
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

		$this->load->model('entradas_model');
		$entradas = $this->entradas_model->get_all_entradas();

		foreach ($entradas as $ent) {

			$array[] = [
				'id' => $ent->id,
				'nome' =>  $ent->desc,
				'valor' => $ent->valor,
			];
		}
		//echo "<pre>";print_r($array);exit(0);
		$data['data'] = (isset($array) ? $array : 'No Register');
		//echo json_encode($json, true);	
		$data['menu'] = 'entradas';
		$data['title'] = "Entradas - Meu Dinheiro";
		$this->load->view('pages/entradas', $data);
	}

	public function update_entrada()
	{
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
		if ($this->db->affected_rows() == 1) {
			$data['msg'] = 'Categoria editada com sucesso!';
		} else {
			$data['msg'] = 'Algo aconteceu e nao conseguimos salvar sua edicao. Tente novamente mais tarde!';
		}

		echo json_encode($data, true);
		//print_r($this->db->affected_rows());exit(0);
	}

	public function nova_entrada()
	{
		$nome = $_GET['nome_nova'];
		$valor = $_GET['valor_nova'];
		$conta = $_GET['conta'];
		//print_r($nome);exit(0);
		$data = array(
			'desc'   =>  $nome,
			'valor' =>  $valor,
			'conta' => $conta,
			'data' =>  date("Y-m-d H:m:s")
		);
		$this->db->insert('entradas', $data);

		if ($this->db->affected_rows() == 1) {

			$this->load->model('contas_model');
			$saldo 		= $this->contas_model->get_saldo_contas_by_id($conta);
			$type_conta = $this->contas_model->get_type_conta_by_id($conta);
			if ($type_conta == 1) {
				$new_saldo = $saldo + $valor;
			} else {
				$new_saldo = $saldo - $valor;
			}

			$new_saldo_save = $this->contas_model->atualizar_saldo($conta, $new_saldo);
			$data['msg'] = 'Categoria editada com sucesso!';
		} else {
			$data['msg'] = 'Algo aconteceu e nao conseguimos salvar sua edicao. Tente novamente mais tarde!';
		}

		echo json_encode($data, true);
		//print_r($this->db->affected_rows());exit(0);
	}
	public function delete_entradas()
	{
		$id = $_GET['id'];

		$this->db->where('id', $id);
		$this->db->delete('entradas');
		if ($this->db->affected_rows() == 1) {
			$data['msg'] = 1;
		} else {
			$data['msg'] = 0;
		}
	}
}
