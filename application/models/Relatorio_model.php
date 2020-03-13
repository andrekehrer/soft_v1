<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Relatorio_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    return;
  }
  public function get_all($mes = null)
  {
    $mes = date('m');
    $query = $this->db->query("select 
                                cor,
                                categorias.id as id,
                                nome,
                                Sum(valor) as valor
                                from `saidas_v`
                                join `categorias` on `categorias`.`id` = `saidas_v`.`categoria_id`
                                where saidas_v.user_id = " . $_SESSION['backend']['userid'] . " and
                                MONTH(data) = " . $mes . "
                                group by categorias.id");
    return $query->result();

    // exit(0);
    // return $this->db->get_where('categorias', array('status' => 1))->result();
  }
  public function get_all_valor($mes = null)
  {
    $mes = date('m');
    $query = $this->db->query("select 
                              Sum(valor) as valor
                              from `saidas_v`
                              where user_id = " . $_SESSION['backend']['userid'] . " and
                              MONTH(data) = " . $mes . "");
    $data = $query->result();
    return $data[0]->valor;

    // exit(0);
    // return $this->db->get_where('categorias', array('status' => 1))->result();
  }
  public function get_all_fixas($mes = null)
  {
    $mes = date('m');
    $query = $this->db->query("select 
                                cor,
                                categorias.id as id,
                                nome,
                                Sum(valor) as valor
                                from `saidas`
                                join `categorias` on `categorias`.`id` = `saidas`.`categoria_id`
                                where pagou = 1 and
                                categorias.user_id = " . $_SESSION['backend']['userid'] . "
                                and MONTH(data_full) = " . $mes . "
                                group by categorias.id");
    return $query->result();

    // exit(0);
    // return $this->db->get_where('categorias', array('status' => 1))->result();
  }
  public function get_all_valor_fixas($mes = null)
  {
    $mes = date('m');
    $query = $this->db->query("select 
                              Sum(valor) as valor
                              from `saidas`
                              where user_id = " . $_SESSION['backend']['userid'] . "
                              and pagou = 1
                              and MONTH(data_full) = " . $mes . "");
    $data = $query->result();
    // print_r($this->db->last_query());
    return $data[0]->valor;

    // exit(0);
    // return $this->db->get_where('categorias', array('status' => 1))->result();
  }
}
