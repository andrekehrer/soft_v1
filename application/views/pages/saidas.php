<?php
if (!isset($_SESSION['backend']['currentSessionId'])) {
  redirect('Login');
}

defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $title ?></title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="<?php echo base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <style>
    #printer_img {
      cursor: pointer;
      width: 35px;
    }

    .table-bordered td,
    .table-bordered th {
      border-top: 1px solid #e3e6f0;
      border-right: 0px;
      border-left: 0px;
    }
  </style>

</head>

<body id="page-top">


  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php require_once('menu.php') ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3" style="border: 2px #65eeef solid;margin-left: 15px;text-align: center;padding: 0px;color: #65eeef;background: #1e3a4c;">
            <span class="fa fa-bars">
              <<</span> </button> <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                  <div class="topbar-divider d-none d-sm-block"></div>

                  <!-- Nav Item - User Information -->
                  <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['backend']['username']; ?></span>
                      <img class="img-profile rounded-circle" src="https://image.flaticon.com/icons/png/128/149/149071.png" height="60" width="60">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                      <a class="dropdown-item" href="#">
                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Profile
                      </a>
                      <a class="dropdown-item" href="#">
                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                        Settings
                      </a>
                      <a class="dropdown-item" href="#">
                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                        Activity Log
                      </a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="<?php echo base_url(); ?>/Logout" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                      </a>
                    </div>
                  </li>

                </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Despesas fixas</h1>
            <a href="#" class="d-sm-inline-block btn btn-sm btn-primary " data-toggle="modal" data-target="#myModal"><i class="fas fa-download fa-sm text-white-50"></i>Adicionar despesa</a>

          </div>

          <div id="myModalPagar" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                  <h4 class="modal-title">Pagar despesa</h4>
                  <div id='loader' style='display: none;'>
                    <img src='<?php echo base_url(); ?>/assets/img/load.gif' width='30px' height='30px'>
                  </div>
                </div>
                <div class="modal-body">
                  <div class="alert alert-success" id="msg_success4" role="alert" style="display:none;margin-top:20px">
                    Obrigado!
                  </div>
                  <form id="myModalPagar" name="myModalPagar">
                    <input type="hidden" class="form-control" name="valor" id="valor">
                    <input type="hidden" class="form-control" name="saida_id_edit" id="id_pagar">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Conta</label>
                      </div>
                      <select class="custom-select" name="conta" id="conta">
                        <option selected>Selecione...</option>
                        <?php foreach ($data_contas as $key => $value) { ?>

                          <option value="<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></option>

                        <?php   } ?>
                      </select>
                    </div>
                    <button type="submit" class="btn btn-default btn-primary">Pagar</button>
                  </form>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal" id="close_modal_novo">Close</button>
                </div>
              </div>

            </div>
          </div>

          <!-- NEW Modal -->
          <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                  <h4 class="modal-title">Nova despesa</h4>
                  <div id='loader' style='display: none;'>
                    <img src='<?php echo base_url(); ?>/assets/img/load.gif' width='30px' height='30px'>
                  </div>
                </div>
                <div class="modal-body">
                  <div class="alert alert-success" id="msg_success2" role="alert" style="display:none;margin-top:20px">
                    Despesa adicionada com sucesso!
                  </div>
                  <form id="myform_new" name="myform_new">
                    <div class="form-group">
                      <label for="email">Nome da despesa</label>
                      <input type="text" class="form-control" name="saida_nome_edit" id="saida_nome_nova">
                    </div>

                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Categoria</label>
                      </div>
                      <select class="custom-select" name="saida_categoria_nova" id="saida_categoria_nova">
                        <option selected>Selecione...</option>
                        <?php foreach ($categorias as $key => $value) { ?>

                          <option value="<?php echo $value->cat_id; ?>"><?php echo $value->nome; ?></option>

                        <?php   } ?>
                      </select>
                    </div>

                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="data_do_mes_novo">Dia do mes</label>
                      </div>
                      <select class="custom-select" name="data_do_mes_novo" id="data_do_mes_novo">
                        <option selected>Selecione...</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="21">22</option>
                        <option value="22">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                      </select>
                    </div>


                    <div class="form-group">
                      <label for="email">Valor</label>
                      <input type="text" class="form-control" name="saida_valor_nova" id="saida_valor_nova">
                    </div>
                    <button type="submit" class="btn btn-default btn-primary">Adicionar</button>
                  </form>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal" id="close_modal_novo">Close</button>
                </div>
              </div>

            </div>
          </div>
          <!-- EDIT Modal -->
          <div id="myModalEdit" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                  <h4 class="modal-title">Editar despesa</h4>
                  <div id='loader' style='display: none;'>
                    <img src='<?php echo base_url(); ?>/assets/img/load.gif' width='30px' height='30px'>
                  </div>
                </div>
                <div class="modal-body">

                  <div class="alert alert-success" id="msg_success" role="alert" style="display:none;margin-top:20px">
                    Despesa alterada com sucesso!
                  </div>
                  <form id="myform_edit" name="myform_edit">

                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Categoria</label>
                      </div>
                      <select class="custom-select" name="saida_categoria_edit" id="saida_categoria_edit">
                        <option selected>Selecione...</option>
                        <?php foreach ($categorias as $key => $value) { ?>

                          <option value="<?php echo $value->cat_id; ?>"><?php echo $value->nome; ?></option>

                        <?php   } ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="email">Nome da despesa</label>
                      <input type="hidden" class="form-control" name="saida_id_edit" id="saida_id_edit">
                      <input type="text" class="form-control" name="saida_nome_edit" id="saida_nome_edit">
                    </div>

                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="data_do_mes_novo">Dia do mes</label>
                      </div>
                      <select class="custom-select" name="data_do_mes_edit" id="data_do_mes_edit">
                        <option selected>Selecione...</option>
                        <option value="01">01</option>
                        <option value="02">02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05">05</option>
                        <option value="06">06</option>
                        <option value="07">07</option>
                        <option value="08">08</option>
                        <option value="09">09</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="21">22</option>
                        <option value="22">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="email">Valor</label>
                      <input type="text" class="form-control" name="saida_valor_edit" id="saida_valor_edit">
                    </div>
                    <button type="submit" class="btn btn-default btn-primary">Salvar</button>
                  </form>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal" id="close_modal_edit">Close</button>
                </div>
              </div>

            </div>
          </div>

          <!-- Content Row -->
          <div class="row">
            <?php if ($data != 'No Register') : ?>
            <div class="table-responsive">
              <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                  <tr style="background: #636363;color: white;">
                    <!--  <th>Id</th> -->
                    <th>Venc</th>
                    <th>Descricao</th>
                    <th>Valor</th>
                    <th>Acoes</th>
                  </tr>
                </thead>

                <tbody id="table_data">
                  

                    <?php
                    $today_date = date("d");
                    $tomorrow = date("d", time() + 86400);
                    // echo "tomorrow: ".$tomorrow;
                    // echo "Today: ".$today_date;
                    foreach ($data as $key => $value) {
                      // echo "<pre>";print_r($value['categoria'][0]->cor);echo "</pre>";
                      // echo "<tr style='background-color:".$value['categoria'][0]->cor."'>";

                      if ($today_date == $value['data']) {
                        echo "<tr style='border: 2px #ff000061 solid;background: #fbf6f6;'>";
                      } elseif ($tomorrow == $value['data']) {
                        echo "<tr style='border: 2px orange solid; background:#fdf0e0'>";
                      } else {
                        echo "<tr>";
                      }

                      if ($value['pagou'] == 1) {
                        echo "<td>";
                        echo "<span style='color: #fff;background: green;padding: 10px;border-radius: 12px;'>" . $value['data'] . "</span>";
                        echo "</td>";
                      } else {
                        echo "<td style='color:black'>";
                        echo $value['data'];
                        echo "</td>";
                      }
                      echo "<td style='color:black'>";
                      echo $value['nome'];
                      echo "</td>";
                      echo "<td style='color:black'>";
                      echo '£' . number_format($value['valor'], 2, ',', '.');
                      echo "</td>";
                      echo "<td>";
                      if ($value['pagou'] == 1) {
                        echo "<img style='cursor: pointer' src='" . base_url() . "/assets/img/verde.png' alt='' width='20' data-sample-valor='" . $value['valor'] . "' data-sample-id='" . $value['id'] . "' data-sample-conta='" . $value['conta'] . "' onclick='despagar(this)'>";
                      } else {
                        // echo "<input type='checkbox' name='' value='' data-sample-id='".$value['id']."' onclick='pagar(this)'>";
                        // echo "<input type='checkbox' name='' value='' data-sample-id='".$value['id']."' onclick='pagar(this)'>";
                        echo "<img src='" . base_url() . "/assets/img/cash.png' data-sample-id='" . $value['id'] . "' data-sample-valor='" . $value['valor'] . "'data-toggle='modal' data-target='#myModalPagar' onclick='myPagar(this)' width='20'>";
                      }
                      echo "<img src='" . base_url() . "/assets/img/edit-icon.png'   data-sample-id='" . $value['id'] . "' data-sample-name='" . $value['nome'] . "' data-sample-valor='" . $value['valor'] . "' data-sample-data='" . $value['data'] . "' data-sample-catid='" . $value['categoria'][0]->cat_id . "' id='printer_img' alt='' onclick='myClick(this)' width='20'>";
                      echo "<img src='" . base_url() . "/assets/img/delete-icon.png' data-sample-id='" . $value['id'] . "' id='printer_img' alt='' onclick='myDelete(this)' width='20'>";
                      echo "<span style='color:black;border: 1px black solid;padding: 2px;border-radius: 5px;background-color:" . $value['categoria'][0]->cor . "'>" . $value['categoria'][0]->nome . "</span>";
                      echo "</td>";
                      echo "</tr>";
                    }
                    ?>

                  
                  <tr>
                    <td style="background: #636363;color: white;">TOTAL</td>
                    <td style="background: #636363;color: white;">

                      <?php
                      $total = 0;
                      if ($data != 'No Register') {
                      foreach ($data as $key => $value) {
                        $total = $total + $value['valor'];
                      }
                      echo '£' . number_format($total, 2, ',', '.');
                      }

                      ?>
                    </td>

                  </tr>
                </tbody>
              </table>
            </div>
            <?php endif ?>
          </div>

          <!-- Content Row -->

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Meu Dinheiro 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <div>^</div>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?php echo base_url(); ?>/Logout">Logout</a>
        </div>
      </div>
    </div>
  </div>


  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url(); ?>assets/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="<?php echo base_url(); ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="<?php echo base_url(); ?>assets/js/demo/datatables-demo.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/jquery.redirect.js"></script>

  <script>
    // function pagar(d) {
    //   var id = d.getAttribute("data-sample-id");
    //   var parms = {
    //     id: id
    //   };

    //   $.ajax({
    //     type: "GET",
    //     url: "<?php echo base_url() ?>/pagar",
    //     data: parms,
    //     dataType: "JSON",
    //     beforeSend: function() {
    //       // Show image container
    //       $("#loader").show();
    //     },
    //     success: function(result) {
    //       console.log(result);
    //       $('#msg_success').css('display', 'block');

    //     },
    //     complete: function(data) {
    //       // Hide image container
    //       $("#loader").hide();
    //       location.reload();
    //     }
    //   });
    // }




    function despagar(d) {
      var id = d.getAttribute("data-sample-id");
      var valor = d.getAttribute("data-sample-valor");
      var conta = d.getAttribute("data-sample-conta");

      var parms = {
        id: id,
        conta: conta,
        valor: valor
      };

      $.ajax({
        type: "GET",
        url: "<?php echo base_url() ?>/despagar",
        data: parms,
        dataType: "JSON",
        beforeSend: function() {
          // Show image container
          $("#loader").show();
        },
        success: function(result) {
          console.log(result);
          $('#msg_success').css('display', 'block');

        },
        complete: function(data) {
          // Hide image container
          $("#loader").hide();
          location.reload();
        }
      });
    }

    function myDelete(d) {
      var id = d.getAttribute("data-sample-id");
      var parms = {
        id: id
      };

      var r = confirm("Deseja deletar?");
      if (r == true) {
        $.ajax({
          type: "GET",
          url: "<?php echo base_url() ?>/delete_saida",
          data: parms,
          dataType: "JSON",
          beforeSend: function() {
            // Show image container
            $("#loader").show();
          },
          success: function(result) {
            console.log(result);
            location.reload();

          },
          complete: function(data) {
            // Hide image container
            location.reload();
            $("#loader").hide();
          }
        });
      } else {

      }

    }

    function myClick(d) {
      $('#msg_success').css('display', 'none');
      var id = d.getAttribute("data-sample-id");
      var name = d.getAttribute("data-sample-name");
      var valor = d.getAttribute("data-sample-valor");
      var cat_id = d.getAttribute("data-sample-catid");
      var data = d.getAttribute("data-sample-data");
      $('#saida_id_edit').val(id);
      $('#saida_nome_edit').val(name);
      $('#saida_valor_edit').val(valor);
      //$("#saida_categoria_edit select").val(cat_id);
      $('#saida_categoria_edit option[value=' + cat_id + ']').attr('selected', 'selected');
      $('#data_do_mes_edit option[value=' + data + ']').attr('selected', 'selected');

      $('#myModalEdit').modal('show');
    }

    function myPagar(d) {
      $('#msg_success').css('display', 'none');
      var id = d.getAttribute("data-sample-id");
      var valor = d.getAttribute("data-sample-valor");
      $('#id_pagar').val(id);
      $('#valor').val(valor);
      $('#myModalPagar').modal('show');
    }
    $(document).ready(function() {

      $('#close_modal_edit').on('click', function() {
        location.reload();
      });
      $('#close_modal_novo').on('click', function() {
        location.reload();
      });


      $('#msg_success').css('display', 'none');

      $('#myform_edit').on('submit', function(e) {
        e.preventDefault();
        var parms = {
          id_edit: $("#saida_id_edit").val(),
          nome_edit: $("#saida_nome_edit").val(),
          categoria: $("#saida_categoria_edit").val(),
          data_mes: $('#data_do_mes_edit').val(),
          valor_edit: $("#saida_valor_edit").val()
        };
        //console.log(parms);

        $.ajax({
          type: "GET",
          url: "<?php echo base_url() ?>/update_saida",
          data: parms,
          dataType: "JSON",
          beforeSend: function() {
            // Show image container
            $("#loader").show();
          },
          success: function(result) {
            console.log(result);
            $('#msg_success').css('display', 'block');

          },
          complete: function(data) {
            // Hide image container
            $("#loader").hide();
          }
        });
      });

      $('#myform_new').on('submit', function(e) {
        e.preventDefault();
        var parms = {
          nome_nova: $("#saida_nome_nova").val(),
          categoria: $("#saida_categoria_nova").val(),
          data_mes: $('#data_do_mes_novo').val(),
          valor_nova: $("#saida_valor_nova").val()
        };
        console.log(parms);

        $.ajax({
          type: "GET",
          url: "<?php echo base_url() ?>/nova_saida",
          data: parms,
          dataType: "JSON",
          beforeSend: function() {
            // Show image container
            $("#loader2").show();
          },
          success: function(result) {
            console.log(result);
            $('#msg_success2').css('display', 'block');

          },
          complete: function(data) {
            // Hide image container
            $("#loader2").hide();
          }
        });
      });

      $('#myModalPagar').on('submit', function(e) {
        e.preventDefault();
        var parms = {
          conta: $("#conta").val(),
          id: $("#id_pagar").val(),
          valor: $("#valor").val()
        };
        console.log(parms);

        $.ajax({
          type: "GET",
          url: "<?php echo base_url() ?>/pagar",
          data: parms,
          dataType: "JSON",
          beforeSend: function() {
            // Show image container
            $("#loader").show();
          },
          success: function(result) {
            console.log(result);
            $('#msg_success4').css('display', 'block');

          },
          complete: function(data) {
            // Hide image container
            $('#msg_success4').css('display', 'block');
            $("#loader").hide();
            //location.reload();
          }
        });
      });

    });
  </script>

</body>

</html>