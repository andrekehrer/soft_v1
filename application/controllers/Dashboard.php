<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{	
		$this->load->model('entradas_model');
		$this->load->model('saidas_model');
		$this->load->model('categorias_model');
		$this->load->model('saidas_model_v');

		////////// TOTAL DESPESAS FIXAS MENSAIS //////////////

		$total_des_fixa = $this->saidas_model->get_all_saidas_pagas();

		$total_des_mes_total = 0;
        foreach ($total_des_fixa as $key => $value) {
          $total_des_mes_total = $total_des_mes_total + $value->valor;
        }
        $total_des_fixa = '£'.number_format($total_des_mes_total, 2, ',', '.');

        ////////////////////////////////////////////////////////

		////////// TOTAL DESPESAS DIARIAS MENSAIS //////////////

		$saidas_diarias = $this->saidas_model_v->get_all_saidas();

		$total_saidas_diarias_total = 0;
        foreach ($saidas_diarias as $key => $value) {
          $total_saidas_diarias_total = $total_saidas_diarias_total + $value->valor;
        }
        $saidas_diarias = '£'.number_format($total_saidas_diarias_total, 2, ',', '.');

        ////////////////////////////////////////////////////////

		////////// TOTAL ENTRADAS FIXAS MENSAIS //////////////

		$total_mes = $this->entradas_model->get_all_entradas();

		$total_mes_total = 0;
        foreach ($total_mes as $key => $value) {
          $total_mes_total = $total_mes_total + $value->valor;
        }
        $total_mes = '£'.number_format($total_mes_total, 2, ',', '.');

        ////////////////////////////////////////////////////////

        ////////// ////////  SALDO MENSAL ////// //////////////

        $saidas_total = $total_des_mes_total + $total_saidas_diarias_total;
        $saldo = ($total_mes_total - $saidas_total);
        $saldo_mensal = '£'.number_format($saldo, 2, ',', '.');
        ////////////////////////////////////////////////////////

        ////////// ////////  SALDO ANUAL / ////// //////////////

        $total_anual = $total_mes_total * 12;
        $total_anual = '£'.number_format($total_anual, 2, ',', '.');


        $today_date = date("d");
        $tomorrow = date("d", time() + 86400);
        $pagar_hoje = $this->saidas_model->get_all_saidas_apagar($today_date);
        if (count($pagar_hoje) >= 1){
            $data['pagar_hoje'] = $pagar_hoje;

            $tota_pagar_hoje_valor = 0;
            foreach ($pagar_hoje as $key => $value) {
                $tota_pagar_hoje_valor = $tota_pagar_hoje_valor + $value->valor;
            }
            $data['tota_pagar_hoje_valor'] = '£'.number_format($tota_pagar_hoje_valor, 2, ',', '.');
            // echo "PAGAR HOJE:  <pre>";print_r($data['tota_pagar_hoje_valor']);echo "</pre>";exit(0);
        }


        // echo "<pre>";print_r($total_mes);exit(0);
        
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