<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Relatorio extends CI_Controller
{

  public function index()
  {
    $mes = date('m');
    $this->load->model('categorias_model');
    $this->load->model('relatorio_model');

    $relatorios = $this->relatorio_model->get_all($mes);
    $data['soma_total'] = $this->relatorio_model->get_all_valor($mes);

    $relatorios_variaveis = $this->relatorio_model->get_all_fixas($mes);
    $data['soma_total_f'] = $this->relatorio_model->get_all_valor_fixas($mes);





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
    $data['id'] = $mes;
    $data['data_contas'] = (isset($array_conta) ? $array_conta : 'No Register');
    $data['relatorios'] = $relatorios;
    $data['relatorios_f'] = $relatorios_variaveis;
    $data['contas'] = count($contas);
    $data['categorias_count'] = count($this->categorias_model->get_all_cats());
    $data['menu'] = 'relatorio';
    $data['title'] = "Relatorio - Meu Dinheiro";
    $this->load->view('pages/relatorio', $data);
  }

  public function relatorio_id($id)
  {
    $this->load->model('categorias_model');
    $this->load->model('relatorio_model');

    $relatorios = $this->relatorio_model->get_all($id);
    $data['soma_total'] = $this->relatorio_model->get_all_valor($id);

    $relatorios_variaveis = $this->relatorio_model->get_all_fixas($id);
    $data['soma_total_f'] = $this->relatorio_model->get_all_valor_fixas($id);


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
    $data['id'] = $id;
    $data['data_contas'] = (isset($array_conta) ? $array_conta : 'No Register');
    $data['relatorios'] = $relatorios;
    $data['relatorios_f'] = $relatorios_variaveis;
    $data['contas'] = count($contas);
    $data['categorias_count'] = count($this->categorias_model->get_all_cats());
    $data['menu'] = 'relatorio';
    $data['title'] = "Relatorio - Meu Dinheiro";
    // echo "<pre>";
    // print_r($data);
    // exit(0);
    $this->load->view('pages/relatorio', $data);
  }
}
