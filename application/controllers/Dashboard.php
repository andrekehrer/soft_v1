<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
        $this->load->model('saidas_model');
        $this->load->model('categorias_model');
        $this->load->model('saidas_model_v');
        $this->load->model('contas_model');
        $this->load->model('dividas_model');

        ////////// TOTAL DESPESAS FIXAS MENSAIS //////////////

        $total_des_fixa = $this->saidas_model->get_all_saidas_pagas();

        $total_des_mes_total = 0;
        foreach ($total_des_fixa as $key => $value) {
            $total_des_mes_total = $total_des_mes_total + $value->valor;
        }
        $total_des_fixa = '£' . number_format($total_des_mes_total, 2, ',', '.');

        ////////////////////////////////////////////////////////

        ////////// TOTAL DESPESAS DIARIAS MENSAIS //////////////

        $saidas_diarias = $this->saidas_model_v->get_all_saidas();

        $total_saidas_diarias_total = 0;
        foreach ($saidas_diarias as $key => $value) {
            $total_saidas_diarias_total = $total_saidas_diarias_total + $value->valor;
        }
        $saidas_diarias = '£' . number_format($total_saidas_diarias_total, 2, ',', '.');

        ////////////////////////////////////////////////////////

        ////////// TOTAL ENTRADAS FIXAS MENSAIS //////////////

        $total_mes = $this->entradas_model->get_all_entradas();

        $total_mes_total = 0;
        foreach ($total_mes as $key => $value) {
            $total_mes_total = $total_mes_total + $value->valor;
        }
        $total_mes = '£' . number_format($total_mes_total, 2, ',', '.');

        ////////////////////////////////////////////////////////

        ////////// ////////  SALDO MENSAL ////// //////////////

        $saidas_total = $total_des_mes_total + $total_saidas_diarias_total;
        $saldo = ($total_mes_total - $saidas_total);
        $saldo_mensal_w = $saldo;
        $saldo_mensal = '£' . number_format($saldo, 2, ',', '.');
        ////////////////////////////////////////////////////////

        ////////// ////////  SALDO ANUAL / ////// //////////////

        $total_anual = $total_mes_total * 12;
        $total_anual = '£' . number_format($total_anual, 2, ',', '.');


        $today_date = date("d");
        $pagar_hoje = $this->saidas_model->get_all_saidas_apagar($today_date);

        if (count($pagar_hoje) >= 1) {

            $data['pagar_hoje'] = $pagar_hoje;
            $tota_pagar_hoje_valor = 0;

            foreach ($pagar_hoje as $key => $value) {
                $tota_pagar_hoje_valor = $tota_pagar_hoje_valor + $value->valor;
            }
            $data['tota_pagar_hoje_valor'] = '£' . number_format($tota_pagar_hoje_valor, 2, ',', '.');
        }

        $tomorrow = date("d", time() + 86400);
        $pagar_amanha = $this->saidas_model->get_all_saidas_apagar($tomorrow);

        if (count($pagar_amanha) >= 1) {

            $data['pagar_amanha'] = $pagar_amanha;
            $tota_pagar_amanha_valor = 0;

            foreach ($pagar_amanha as $key => $value) {
                $tota_pagar_amanha_valor = $tota_pagar_amanha_valor + $value->valor;
            }
            $data['tota_pagar_amanha_valor'] = '£' . number_format($tota_pagar_amanha_valor, 2, ',', '.');
        }

        $all_contas_cartoes = $this->contas_model->get_all_contas(1);

        $total_cartoes = 0;
        foreach ($all_contas_cartoes as $key => $value) {
            $total_cartoes = $total_cartoes + $value->saldo;
        }
        $all_contas_cartoes_w = $total_cartoes;
        $all_contas_cartoes = '£' . number_format($total_cartoes, 2, ',', '.');



        $total_dividas = $this->dividas_model->get_all_dividas();

        $divida_mes = 0;
        foreach ($total_dividas as $key => $value) {
            $divida_mes = $divida_mes + $value->valor;
        }
        $total_dividas = $divida_mes;

        $saldo_negativo = 0;
        $contas_negativo = $this->contas_model->get_conta_negativo();
        foreach ($contas_negativo as $key => $value) {
            if ($value->saldo < 0) {
                $saldo_negativo = $saldo_negativo + $value->saldo;
            }
        }

        $situcao = ((($all_contas_cartoes_w + $total_dividas) * -1) + $saldo_negativo);
        // echo "<pre>";
        // print_r($situcao);
        // exit(0);

        $data['situcao'] = $situcao;
        $data['cartoes'] = $all_contas_cartoes;
        $data['menu'] = 'dashboard';
        $data['total_pagar_amanha'] = count($pagar_amanha);
        $data['total_pagar_hoje'] = count($pagar_hoje);
        $data['total_anual'] = $total_anual;
        $data['total_des_fixa'] = $total_des_fixa;
        $data['saldo_mensal'] = $saldo_mensal;
        $data['total_mes'] = $total_mes;
        $data['total_bill'] = $this->saidas_model->get_all_saidas_apagar();
        $data['saidas_diarias'] = $saidas_diarias;
        $data['title'] = "Dashboard - Meu Dinheiro";

        $this->load->view('pages/dashboard', $data);
    }
}
