<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dividas extends CI_Controller
{

	public function index()
	{
		$this->load->model('categorias_model');
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

		$this->load->model('dividas_model');
		$categorias = $this->dividas_model->get_all_dividas();

		foreach ($categorias as $cat) {

			$array[] = [
				'id' => $cat->id,
				'nome' =>  $cat->nome,
				'valor' => $cat->valor,
			];
		}
		//echo "<pre>";print_r($array);exit(0);
		$data['data'] = (isset($array) ? $array : 'No Register');
		$data['categorias_count'] = count($this->categorias_model->get_all_cats());
		$data['menu'] = 'dividas';
		$data['title'] = "Dividas - Meu Dinheiro";
		$this->load->view('pages/dividas', $data);
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
		$this->db->where('user_id', $_SESSION['backend']['userid']);
		$this->db->where('id', $id);
		$this->db->update('dividas', $data);
		if ($this->db->affected_rows() == 1) {
			$data['msg'] = 'Categoria editada com sucesso!';
		} else {
			$data['msg'] = 'Algo aconteceu e nao conseguimos salvar sua edicao. Tente novamente mais tarde!';
		}

		echo json_encode($data, true);
		//print_r($this->db->affected_rows());exit(0);
	}

	public function nova_divida()
	{
		$nome = $_GET['nome_nova'];
		$valor = $_GET['valor_nova'];
		//print_r($nome);exit(0);
		$data = array(
			'nome'   =>  $nome,
			'valor'  =>  $valor,
			'user_id' => $_SESSION['backend']['userid']
		);
		$this->db->insert('dividas', $data);

		if ($this->db->affected_rows() == 1) {

			$data['msg'] = 'Categoria editada com sucesso!';
		} else {
			$data['msg'] = 'Algo aconteceu e nao conseguimos salvar sua edicao. Tente novamente mais tarde!';
		}

		echo json_encode($data, true);
		//print_r($this->db->affected_rows());exit(0);
	}
	public function valor_divida_pagar()
	{
		$this->load->model('dividas_model');

		$divida = $_GET['divida'];
		$cartao = $_GET['cartao'];
		$valor = $_GET['valor'];

		$pagar = $this->dividas_model->pagar_divida($divida, $valor);
		$divida_name = $this->dividas_model->divida_name_by_id($divida);

		$data_saida_nova = array(
			'desc'  	    =>  $divida_name,
			'valor' 	    =>  $valor,
			'data' 			=>  date("Y-m-d h:m:s"),
			'categoria_id'  =>  1111,
			'conta'         => $cartao,
			'user_id'		=> $_SESSION['backend']['userid']
		);

		$this->db->insert('saidas_v', $data_saida_nova);

		if ($this->db->affected_rows() == 1) {

			$this->load->model('contas_model');
			$saldo 		= $this->contas_model->get_saldo_contas_by_id($cartao);
			$type_conta = $this->contas_model->get_type_conta_by_id($cartao);
			if ($type_conta == 1) {
				$new_saldo = $saldo + $valor;
			} else {
				$new_saldo = $saldo - $valor;
			}

			$new_saldo_save = $this->contas_model->atualizar_saldo($cartao, $new_saldo);

			$data['msg'] = 'Categoria editada com sucesso!';
		} else {
			$data['msg'] = 'Algo aconteceu e nao conseguimos salvar sua edicao. Tente novamente mais tarde!';
		}


		print_r($_GET);
		exit(0);
	}
	public function delete_dividas()
	{
		$id = $_GET['id'];

		$this->db->where('user_id', $_SESSION['backend']['userid']);
		$this->db->where('id', $id);
		$this->db->delete('dividas');
		if ($this->db->affected_rows() == 1) {
			$data['msg'] = 1;
		} else {
			$data['msg'] = 0;
		}
	}
}
