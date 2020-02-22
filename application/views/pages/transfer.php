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
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-body">
                <div class="alert alert-success" id="msg_success2" role="alert" style="display:none;margin-top:20px">
                  Transferencia realizada com sucesso!
                </div>
                <form id="myform_new" name="myform_new">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="inputGroupSelect01">De:</label>
                    </div>
                    <select class="custom-select" name="conta1" id="conta1">
                      <option selected>Selecione...</option>
                      <?php foreach ($data_contas as $key => $value) {
                        if ($value['cartao'] == 0) {
                      ?>
                          <option value="<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></option>
                      <?php   }
                      } ?>
                    </select>
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <label class="input-group-text" for="inputGroupSelect01">Para:</label>
                    </div>
                    <select class="custom-select" name="conta2" id="conta2">
                      <option selected>Selecione...</option>
                      <?php foreach ($data_contas as $key => $value) {
                        if ($value['cartao'] == 0) {
                      ?>
                          <option value="<?php echo $value['id']; ?>"><?php echo $value['nome']; ?></option>
                      <?php   }
                      } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="email">Valor</label>
                    <input type="text" class="form-control" name="valor_transfer" id="valor_transfer">
                  </div>
                  <button type="submit" class="btn btn-default btn-primary">Transferir</button>
                </form>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" id="close_modal">Close</button>
              </div>
            </div>

          </div>
        </div>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4" style="border-top: 1px #ddd solid;margin-top: 40px;padding: 10px;">
            <h1 class="h3 mb-0 text-gray-800" style="font-size: 16px">Transferencia entre contas</h1><br>
            <a href="#" class="d-sm-inline-block btn btn-sm btn-primary " data-toggle="modal" data-target="#myModal"><i class="fas fa-download fa-sm text-white-50"></i>Transferir</a>
          </div>
          <!-- Content Row -->
          <div class="row">

          </div>
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
            conta1: $("#conta1").val(),
            conta2: $("#conta2").val(),
            valor: $('#valor_transfer').val()
          };
          console.log(parms);

          $.ajax({
            type: "GET",
            url: "<?php echo base_url() ?>/fazer_transfer",
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