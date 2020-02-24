<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Relatorio extends CI_Controller
{

  public function index()
  {
    $this->load->model('categorias_model');
    $this->load->model('relatorio_model');

    $relatorios = $this->relatorio_model->get_all();
    $data['soma_total'] = $this->relatorio_model->get_all_valor();

    $relatorios_variaveis = $this->relatorio_model->get_all_fixas();
    $data['soma_total_f'] = $this->relatorio_model->get_all_valor_fixas();





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
    $data['relatorios_f'] = $relatorios_variaveis;
    $data['contas'] = count($contas);
    $data['categorias_count'] = count($this->categorias_model->get_all_cats());
    $data['menu'] = 'relatorio';
    $data['title'] = "Relatorio - Meu Dinheiro";
    $this->load->view('pages/relatorio', $data);
  }
}
