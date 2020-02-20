<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transfer extends CI_Controller
{

  public function index()
  {
    $this->load->model('relatorio_model');

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
    //echo json_encode($json, true);	
    $data['menu'] = 'transfer';
    $data['title'] = "Trasnferir entre contas - Meu Dinheiro";
    $this->load->view('pages/transfer', $data);
  }

  public function fazer_transfer()
  {
    $this->load->model('contas_model');

    $conta1 = $_GET['conta1'];
    $conta2 = $_GET['conta2'];
    $valor = $_GET['valor'];

    $saldo1    = $this->contas_model->get_saldo_contas_by_id($conta1);
    $saldo2     = $this->contas_model->get_saldo_contas_by_id($conta2);
    $new_saldo_saindo = $saldo1 - $valor;
    $new_saldo_entrando = $saldo2 + $valor;

    $this->contas_model->atualizar_saldo($conta1, $new_saldo_saindo);
    $this->contas_model->atualizar_saldo($conta2, $new_saldo_entrando);

    $data['msg'] = 'Categoria editada com sucesso!';
    echo json_encode($data, true);
    //print_r($this->db->affected_rows());exit(0);
  }
}
