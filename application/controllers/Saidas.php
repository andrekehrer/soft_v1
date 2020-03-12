<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Saidas extends CI_Controller
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


		$this->load->model('saidas_model');
		$this->load->model('categorias_model');
		$saidas = $this->saidas_model->get_all_saidas();
		// print_r($saidas);
		// exit(0);
		foreach ($saidas as $sai) {

			$array[] = [
				'id' => $sai->id,
				'nome' =>  $sai->desc,
				'valor' => $sai->valor,
				'categoria' => $this->saidas_model->get_cat_by_id($sai->categoria_id),
				'data' => $sai->data,
				'pagou' => $sai->pagou,
				'conta' => $sai->conta,
			];
		}


		$data['categorias'] = $this->categorias_model->get_all_cats();
		$data['data'] = (isset($array) ? $array : 'No Register');
		$data['categorias_count'] = count($this->categorias_model->get_all_cats());
		$data['title'] = "Saidas - Meu Dinheiro";
		$data['menu'] = 'saidas';
		$this->load->view('pages/saidas', $data);
	}

	public function update_saida()
	{
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
		$this->db->where('user_id', $_SESSION['backend']['userid']);
		$this->db->where('id', $id);
		$this->db->update('saidas', $data);
		if ($this->db->affected_rows() == 1) {
			$data['msg'] = 'Categoria editada com sucesso!';
		} else {
			$data['msg'] = 'Algo aconteceu e nao conseguimos salvar sua edicao. Tente novamente mais tarde!';
		}

		echo json_encode($data, true);
		//print_r($this->db->affected_rows());exit(0);
	}

	public function nova_saida()
	{
		$nome = $_GET['nome_nova'];
		$categoria = $_GET['categoria'];
		$data_ = $_GET['data_mes'];
		$valor = $_GET['valor_nova'];


		//print_r($nome);exit(0);
		$data = array(
			'desc'   =>  $nome,
			'valor' =>  $valor,
			'data' =>  $data_,
			'categoria_id' =>  $categoria,
			'user_id' => $_SESSION['backend']['userid']
		);
		$this->db->insert('saidas', $data);

		if ($this->db->affected_rows() == 1) {
			$data['msg'] = 'Categoria editada com sucesso!';
		} else {
			$data['msg'] = 'Algo aconteceu e nao conseguimos salvar sua edicao. Tente novamente mais tarde!';
		}

		echo json_encode($data, true);
		//print_r($this->db->affected_rows());exit(0);
	}

	public function delete_saida()
	{
		$id = $_GET['id'];

		$this->db->where('user_id', $_SESSION['backend']['userid']);
		$this->db->where('id', $id);
		$this->db->delete('saidas');
		if ($this->db->affected_rows() == 1) {
			$data['msg'] = 1;
		} else {
			$data['msg'] = 0;
		}
	}

	public function pagar()
	{
		$id    = $_GET['id'];
		$conta = $_GET['conta'];
		$valor = $_GET['valor'];
		$data  = array(
			'pagou'     =>  1,
			'conta'	  	=>  $conta,
			'data_full' => date('Y-m-d H:m:s')
		);
		$this->db->where('user_id', $_SESSION['backend']['userid']);
		$this->db->where('id', $id);
		$this->db->update('saidas', $data);
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
			$data['msg'] = 1;
		} else {
			$data['msg'] = 0;
		}
	}
	public function despagar()
	{
		$id = $_GET['id'];
		$valor = $_GET['valor'];
		$conta = $_GET['conta'];
		$data = array(
			'pagou'     =>  0,
			'valor'		  => $valor,
			'conta'		  => null,
			'data_full' => null
		);
		$this->db->where('user_id', $_SESSION['backend']['userid']);
		$this->db->where('id', $id);
		$this->db->update('saidas', $data);
		if ($this->db->affected_rows() == 1) {

			$this->load->model('contas_model');
			$saldo 		= $this->contas_model->get_saldo_contas_by_id($conta);
			$type_conta = $this->contas_model->get_type_conta_by_id($conta);
			if ($type_conta == 1) {
				$new_saldo = $saldo - $valor;
			} else {
				$new_saldo = $saldo + $valor;
			}
			$new_saldo_save = $this->contas_model->atualizar_saldo($conta, $new_saldo);

			$data['msg'] = 1;
		} else {
			$data['msg'] = 0;
		}
	}
}
