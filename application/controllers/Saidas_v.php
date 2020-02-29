<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Saidas_v extends CI_Controller
{

	public function index()
	{
		$this->load->model('dividas_model');
		$this->load->model('contas_model');

		$contas = $this->contas_model->get_all_contas();
		foreach ($contas as $cat) {
			$array_conta[] = [
				'id' => 	$cat->id,
				'nome' =>   $cat->nome,
				'saldo' =>  $cat->saldo,
				'cartao' => $cat->cartao,
			];
		}
		$data['data_contas'] = (isset($array_conta) ? $array_conta : 'No Register');
		$data['contas'] = count($contas);

		$this->load->model('saidas_model_v');
		$this->load->model('categorias_model');
		$categorias = $this->saidas_model_v->get_all_saidas();

		foreach ($categorias as $cat) {

			$array[] = [
				'id' => $cat->id,
				'nome' =>  $cat->desc,
				'valor' => $cat->valor,
				'categoria' => $this->saidas_model_v->get_cat_by_id($cat->categoria_id),
				'data' => $cat->data,
				'nome_b' => $cat->nome,
			];
		}
		$data['dividas'] = $this->dividas_model->get_all_dividas();

		$data['categorias'] = $this->categorias_model->get_all_cats();
		$data['data'] = (isset($array) ? $array : 'No Register');
		$data['categorias_count'] = count($this->categorias_model->get_all_cats());
		$data['menu'] = 'saidas';
		$data['title'] = "Saidas Variaveis - Meu Dinheiro";
		$this->load->view('pages/saidas_v', $data);
	}

	public function update_saida_v()
	{
		$id = $_GET['id_edit'];
		$nome = $_GET['nome_edit'];
		$valor = $_GET['valor_edit'];
		$cat_id = $_GET['categoria'];

		$data = array(
			'desc'  =>  $nome,
			'valor' =>  $valor,
			'categoria_id' =>  $cat_id
		);
		$this->db->where('user_id', $_SESSION['backend']['userid']);
		$this->db->where('id', $id);
		$this->db->update('saidas_v', $data);
		if ($this->db->affected_rows() == 1) {
			$data['msg'] = 'Categoria editada com sucesso!';
		} else {
			$data['msg'] = 'Algo aconteceu e nao conseguimos salvar sua edicao. Tente novamente mais tarde!';
		}

		echo json_encode($data, true);
		//print_r($this->db->affected_rows());exit(0);
	}

	public function nova_saida_v()
	{
		$nome = $_GET['nome_nova'];
		$categoria = $_GET['categoria'];
		$data_ = $_GET['data_mes'];
		$valor = $_GET['valor_nova'];
		$conta_saida = $_GET['conta_saida'];


		//print_r($nome);exit(0);
		$data = array(
			'desc'   =>  $nome,
			'valor' =>  $valor,
			'data' =>  $data_,
			'categoria_id' =>  $categoria,
			'conta' => $conta_saida,
			'user_id' => $_SESSION['backend']['userid']
		);


		$this->db->insert('saidas_v', $data);

		if ($this->db->affected_rows() == 1) {

			$this->load->model('contas_model');
			$saldo 		= $this->contas_model->get_saldo_contas_by_id($conta_saida);
			$type_conta = $this->contas_model->get_type_conta_by_id($conta_saida);
			if ($type_conta == 1) {
				$new_saldo = $saldo + $valor;
			} else {
				$new_saldo = $saldo - $valor;
			}

			$new_saldo_save = $this->contas_model->atualizar_saldo($conta_saida, $new_saldo);

			$data['msg'] = 'Categoria editada com sucesso!';
		} else {
			$data['msg'] = 'Algo aconteceu e nao conseguimos salvar sua edicao. Tente novamente mais tarde!';
		}

		echo json_encode($data, true);
		//print_r($this->db->affected_rows());exit(0);
	}

	public function delete_saida_v()
	{
		$this->load->model('dividas_model');
		$this->load->model('saidas_model_v');

		$id_ = $_GET['id'];

		$saida_v = $this->saidas_model_v->get_saidas_v_by_id($id_);

		$id = $saida_v[0]->id;
		$desc = $saida_v[0]->desc;
		$valor = $saida_v[0]->valor;
		$categoria_id = $saida_v[0]->categoria_id;
		$conta = $saida_v[0]->conta;

		$this->load->model('contas_model');
		$saldo 		= $this->contas_model->get_saldo_contas_by_id($conta);
		$type_conta = $this->contas_model->get_type_conta_by_id($conta);
		if ($type_conta == 1) {
			$new_saldo = $saldo - $valor;
		} else {
			$new_saldo = $saldo + $valor;
		}

		$new_saldo_save = $this->contas_model->atualizar_saldo($conta, $new_saldo);

		if ($categoria_id == 1111) {
			$voltar_divida = $this->dividas_model->voltar_divida($desc, $valor);
		}
		$this->db->where('user_id', $_SESSION['backend']['userid']);
		$this->db->where('id', $id_);
		$this->db->delete('saidas_v');
		if ($this->db->affected_rows() == 1) {
			$data['msg'] = 1;
		} else {
			$data['msg'] = 0;
		}
	}

	public function get_saidas_v_by_conta(){
		$this->load->model('saidas_model_v');

		$id_ = $_GET['id'];
		// $data = $this->db->get_where('saidas_v', array('conta' => $id_, 'user_id' => $_SESSION['backend']['userid']))->result();

		$this->db->select('*');
		$this->db->from('saidas_v');
		$this->db->join('contas', 'contas.id = saidas_v.conta');
		$this->db->order_by('data', 'DESC');
		$mes_corrente = date('m');
		if($id_ != 'todos'){
			$this->db->where('saidas_v.conta', $id_);
		}
		$this->db->where('saidas_v.user_id', $_SESSION['backend']['userid']);
		$this->db->where('MONTH(data)', $mes_corrente)->order_by('data', 'DESC');
		$query = $this->db->get()->result();


		foreach ($query as $cat) {

			$array[] = [
				'id' => $cat->id,
				'desc' =>  $cat->desc,
				'valor' => $cat->valor,
				'categoria' => $this->saidas_model_v->get_cat_by_id($cat->categoria_id),
				'data' => $cat->data,
				'nome' => $cat->nome,
			];
		}


		echo json_encode($array, true);

	}


}
