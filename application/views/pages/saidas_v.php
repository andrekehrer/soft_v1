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
  <link rel="icon" type="image/png" href="https://www.meudinheiroweb.com.br/assets/img/favicon/32x32.png" sizes="32x32">
  <!-- Custom styles for this template -->
  <link href="<?php echo base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <style>
    #printer_img {
      cursor: pointer;
      width: 30px;
      padding: 5px;
    }

    .nome_trans {
      -webkit-transform: rotate(-90deg);
      -moz-transform: rotate(-90deg);
      -ms-transform: rotate(-90deg);
      -o-transform: rotate(-90deg);
      transform: rotate(-90deg);
      font-size: 10px;
      text-align: center;
    }

    .th_ak {
      padding: 4px 12px;
    }

    .table-bordered td,
    .table-bordered th {
      border: 0px solid #e3e6f0;
      font-size: 11px;
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
            <h1 class="h3 mb-0 text-gray-800">Despesas variaveis</h1>
            <a href="#" class="d-sm-inline-block btn btn-sm btn-primary " data-toggle="modal" data-target="#myModal"><i class="fas fa-download fa-sm text-white-50"></i>Adicionar despesa</a>
            <a href="#" class="d-sm-inline-block btn btn-sm btn-primary " data-toggle="modal" data-target="#pagarDivida"><i class="fas fa-download fa-sm text-white-50"></i>Pagar divida</a>

          </div>

          <!-- NEW Modal -->
          <div id="pagarDivida" class="modal fade" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                  <h4 class="modal-title">Pagar divida</h4>
                  <div id='loader' style='display: none;'>
                    <img src='<?php echo base_url(); ?>/assets/img/load.gif' width='30px' height='30px'>
                  </div>
                </div>
                <div class="modal-body">
                  <div class="alert alert-success" id="msg_success2" role="alert" style="display:none;margin-top:20px">
                    Obrigado pelo pagamento!
                  </div>
                  <form id="pagarDivida" name="pagarDivida">

                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Divida</label>
                      </div>
                      <select class="custom-select" name="divida" id="divida">
                        <option selected>Selecione...</option>
                        <?php foreach ($dividas as $key => $value) { ?>

                          <option value="<?php echo $value->id; ?>"><?php echo $value->nome; ?></option>

                        <?php   } ?>
                      </select>
                    </div>

                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Conta</label>
                      </div>
                      <select class="custom-select" name="cartao" id="cartao">
                        <option selected>Selecione...</option>
                        <?php foreach ($data_contas as $key => $value) { ?>

                          <option value="<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></option>

                        <?php   } ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="email">Valor</label>
                      <input type="text" class="form-control" name="valor_divida" id="valor_divida">
                    </div>
                    <button type="submit" class="btn btn-default btn-primary">Adicionar</button>
                  </form>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal" id="close_modal_divida">Close</button>
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
                  <div class="alert alert-success" id="msg_success6" role="alert" style="display:none;margin-top:20px">
                    Despesa adicionada com sucesso!
                  </div>
                  <form id="myform_new" name="myform_new">

                    <div class="form-group">
                      <label for="email">Data</label>
                      <input type="date" name="data_despesa_nova" id="data_despesa_nova" required>
                    </div>
                    <div class="form-group">
                      <label for="email">Nome da despesa</label>
                      <input type="text" class="form-control" name="saida_nome_edit" id="saida_nome_nova" required>
                    </div>

                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Categoria</label>
                      </div>
                      <select class="custom-select" name="saida_categoria_nova" id="saida_categoria_nova" required>
                        <option value="0" selected>Selecione...</option>
                        <?php foreach ($categorias as $key => $value) { ?>

                          <option value="<?php echo $value->id; ?>"><?php echo $value->nome; ?></option>

                        <?php   } ?>
                      </select>
                    </div>

                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Conta</label>
                      </div>
                      <select class="custom-select" name="conta_saida" id="conta_saida" required>
                        <option value="0" selected>Selecione...</option>
                        <?php foreach ($data_contas as $key => $value) { ?>

                          <option value="<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></option>

                        <?php   } ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="email">Valor</label>
                      <input type="text" class="form-control" name="saida_valor_nova" id="saida_valor_nova" required>
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

                          <option value="<?php echo $value->id; ?>"><?php echo $value->nome; ?></option>

                        <?php   } ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="email">Nome da despesa</label>
                      <input type="hidden" class="form-control" name="saida_id_edit" id="saida_id_edit">
                      <input type="text" class="form-control" name="saida_nome_edit" id="saida_nome_edit">
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
            <div class="table-responsive">
              <?php if ($data != 'No Register') : ?>
                <table class="table-bordered ak" style="width:100%" cellspacing="0">
                  <thead>
                    <tr style="background: #636363;color: white;">
                      <!--  <th>Id</th> -->
                      <th></th>
                      <th class="th_ak">Data</th>
                      <th class="th_ak">Descricao</th>
                      <th class="th_ak">Valor</th>
                      <th class="th_ak">Acoes</th>
                    </tr>
                  </thead>

                  <tbody id="table_data">

                    <?php

                    foreach ($data as $key => $value) {
                      // echo "<pre>";print_r($value['categoria'][0]->cor);echo "</pre>";

                      echo "<tr style='background-color:" . $value['categoria'][0]->cor . "'>";
                      echo "<td width='1%' height='80' class='nome_trans'>";
                      echo "<span >" . $value['nome_b'] . "</span>";
                      echo "</td>";
                      echo "<td class='th_ak' style='color:black'>";
                      $date = date_create($value['data']);
                      echo date_format($date, "d/m/Y");
                      echo "</td>";
                      echo "<td class='th_ak' style='color:black'>";
                      echo $value['nome'];
                      echo "</td>";
                      echo "<td class='th_ak' style='color:black'>";
                      echo '£' . number_format($value['valor'], 2, ',', '.');
                      echo "</td>";
                      echo "<td class='th_ak'>";
                      echo "<img src='" . base_url() . "/assets/img/edit-icon.png'   data-sample-id='" . $value['id'] . "' data-sample-name='" . $value['nome'] . "' data-sample-valor='" . $value['valor'] . "' data-sample-data='" . $value['data'] . "' data-sample-catid='" . $value['categoria'][0]->id . "' id='printer_img' alt='' onclick='myClick(this)' width='20'>";
                      echo "<img src='" . base_url() . "/assets/img/delete-icon.png' data-sample-id='" . $value['id'] . "' id='printer_img' alt='' onclick='myDelete(this)' width='20'>";
                      echo "</td>";
                      echo "</tr>";
                    }
                    ?>

                    <tr>
                      <td class='th_ak' style="background: #636363;color: white;">TOTAL</td>
                      <td class='th_ak' style="background: #636363;color: white;">

                        <?php
                        $total = 0;
                        foreach ($data as $key => $value) {
                          $total = $total + $value['valor'];
                        }
                        echo '£' . number_format($total, 2, ',', '.');
                        ?>
                      </td>

                    </tr>
                  </tbody>
                </table>
              <?php endif ?>
            </div>

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
    function myDelete(d) {
      var id = d.getAttribute("data-sample-id");
      var parms = {
        id: id
      };

      var r = confirm("Deseja deletar?");
      if (r == true) {
        $.ajax({
          type: "GET",
          url: "<?php echo base_url() ?>/delete_saida_v",
          data: parms,
          dataType: "JSON",
          beforeSend: function() {
            // Show image container
            $("#loader").show();
          },
          success: function(result) {
            console.log(result);
            //location.reload();

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
      //var data = d.getAttribute("data-sample-data");
      $('#saida_id_edit').val(id);
      $('#saida_nome_edit').val(name);
      $('#saida_valor_edit').val(valor);
      //$("#saida_categoria_edit select").val(cat_id);
      $('#saida_categoria_edit option[value=' + cat_id + ']').attr('selected', 'selected');
      //$('#data_do_mes_edit option[value='+data+']').attr('selected','selected');

      $('#myModalEdit').modal('show');
    }

    $(document).ready(function() {

      $('#close_modal_edit').on('click', function() {
        location.reload();
      });
      $('#close_modal_novo').on('click', function() {
        location.reload();
      });
      $('#close_modal_divida').on('click', function() {
        location.reload();
      });


      $('#msg_success').css('display', 'none');

      $('#myform_edit').on('submit', function(e) {
        e.preventDefault();
        var parms = {
          id_edit: $("#saida_id_edit").val(),
          nome_edit: $("#saida_nome_edit").val(),
          categoria: $("#saida_categoria_edit").val(),
          //data_mes  : $('#data_do_mes_edit').val(),
          valor_edit: $("#saida_valor_edit").val()
        };
        //console.log(parms);

        $.ajax({
          type: "GET",
          url: "<?php echo base_url() ?>/update_saida_v",
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

      $('#pagarDivida').on('submit', function(e) {
        e.preventDefault();
        var parms = {
          divida: $("#divida").val(),
          cartao: $("#cartao").val(),
          valor: $("#valor_divida").val(),
        };
        console.log(parms);

        $.ajax({
          type: "GET",
          url: "<?php echo base_url() ?>/valor_divida_pagar",
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
            $('#msg_success2').css('display', 'block');
            $("#loader2").hide();
          }
        });
      });

      $('#myform_new').on('submit', function(e) {
        e.preventDefault();
        var conta_saida_ = $("#conta_saida").val();
        var categoria_ = $("#saida_categoria_nova").val();
        var parms = {
          nome_nova: $("#saida_nome_nova").val(),
          categoria: categoria_,
          data_mes: $('#data_despesa_nova').val(),
          valor_nova: $("#saida_valor_nova").val(),
          conta_saida: conta_saida_
        };
        console.log(parms);
        if (conta_saida_ == 0) {
          alert('Selecione uma conta!');
        } else {
          if (categoria_ == 0) {
            alert('Selecione uma categoria!');
          } else {
            $.ajax({
              type: "GET",
              url: "<?php echo base_url() ?>/nova_saida_v",
              data: parms,
              dataType: "JSON",
              beforeSend: function() {
                // Show image container
                $("#loader2").show();
              },
              success: function(result) {
                console.log(result);
                $('#msg_success6').css('display', 'block');

              },
              complete: function(data) {
                // Hide image container
                $('#msg_success6').css('display', 'block');
                $("#loader2").hide();
              }
            });
          }
        }
      });

    });
  </script>

</body>

</html>