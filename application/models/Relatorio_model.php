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
                                cat_id as id,
                                nome,
                                Sum(valor) as valor
                                from `saidas_v`
                                join `categorias` on `categorias`.`cat_id` = `saidas_v`.`categoria_id`
                                where MONTH(data) = " . $mes . "
                                group by cat_id");
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
                              where MONTH(data) = " . $mes . "");
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
                                cat_id as id,
                                nome,
                                Sum(valor) as valor
                                from `saidas`
                                join `categorias` on `categorias`.`cat_id` = `saidas`.`categoria_id`
                                where pagou = 1
                                group by cat_id");
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
                              where pagou = 1");
    $data = $query->result();
    return $data[0]->valor;

    // exit(0);
    // return $this->db->get_where('categorias', array('status' => 1))->result();
  }
}
