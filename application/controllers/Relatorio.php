<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Relatorio extends CI_Controller
{

  public function index()
  {
    $this->load->model('relatorio_model');
    $relatorios = $this->relatorio_model->get_all();
    $data['soma_total'] = $this->relatorio_model->get_all_valor();





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
    $data['relatorios'] = $relatorios;
    $data['contas'] = count($contas);
    //echo json_encode($json, true);	
    $data['menu'] = 'relatorio';
    $data['title'] = "Relatorio - Meu Dinheiro";
    $this->load->view('pages/relatorio', $data);
  }
}
