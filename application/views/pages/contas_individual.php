<?php
if (!isset($_SESSION['backend']['currentSessionId'])) {redirect('Login');}

defined('BASEPATH') OR exit('No direct script access allowed');
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
    #printer_img{
      cursor: pointer;
      width: 35px;
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
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                      <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
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
                      <h1 class="h3 mb-0 text-gray-800"><?php echo $nome_conta; ?></h1>
                      <a href="#" class="d-sm-inline-block btn btn-sm btn-primary " data-toggle="modal" data-target="#myModal"><i class="fas fa-download fa-sm text-white-50"></i>Adicionar categoria</a>

                    </div>

                    <!-- NEW Modal -->
                    <div id="myModal" class="modal fade" role="dialog">
                      <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                            <h4 class="modal-title">Nova categoria</h4>
                            <div id='loader' style='display: none;'>
                              <img src='<?php echo base_url(); ?>/assets/img/load.gif' width='30px' height='30px'>
                            </div>
                          </div>
                          <div class="modal-body">
                            <div class="alert alert-success" id="msg_success2" role="alert" style="display:none;margin-top:20px">
                              Categoria alterada com sucesso!
                            </div>
                            <form id="myform_new" name="myform_new">
                              <input type="color" id="cor_nova" name="cor_nova">
                              <div class="form-group">
                                <label for="email">Nome da categoria</label>
                                <input type="text" class="form-control" name="categoria_nome_nova" id="categoria_nome_nova">
                              </div>
                              <button type="submit" class="btn btn-default btn-primary">Adicionar</button>
                            </form>
                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal" id="close_modal_edit">Close</button>
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
                            <h4 class="modal-title">Editar categoria</h4>
                            <div id='loader' style='display: none;'>
                              <img src='<?php echo base_url(); ?>/assets/img/load.gif' width='30px' height='30px'>
                            </div>
                          </div>
                          <div class="modal-body">

                            <div class="alert alert-success" id="msg_success" role="alert" style="display:none;margin-top:20px">
                              Categoria alterada com sucesso!
                            </div>
                            <form id="myform_edit" name="myform_edit">
                              <input type="color" id="cor_edit" name="cor_edit">
                              <div class="form-group">
                                <label for="email">Nome da categoria</label>
                                <input type="hidden" class="form-control" name="categoria_id_edit" id="categoria_id_edit">
                                <input type="text" class="form-control" name="categoria_nome_edit" id="categoria_nome_edit">
                              </div>
                              <button type="submit" class="btn btn-default btn-primary">Salvar</button>
                            </form>
                          </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal" id="close_modal_novo">Close</button>
                          </div>
                        </div>

                      </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                      <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                          <thead>
                            <tr>
                             <!--  <th>Id</th> -->
                             <th>Data</th>
                             <th>Nome</th>
                             <th>Saldo</th>
                             <th>Acoes</th>
                           </tr>
                         </thead>

                         <tbody id="table_data">
                          <?php if ($data_): ?>

                            <?php
                            foreach ($data_ as $key => $value) {
                              echo "<tr>";
                                echo "<td>";
                                  $date=date_create($value['data']);
                                  echo date_format($date,"d/m/Y");
                                echo "</td>";
                                echo "<td>";
                                  echo $value['nome'];
                                echo "</td>";
                                echo "<td>";
                                  echo '£'.number_format($value['saldo'], 2, ',', '.');
                                echo "</td>";
                                echo "<td>";
                                  echo "<img src='".base_url()."/assets/img/edit-icon.png'   data-sample-id='".$value['id']."' data-sample-name='".$value['nome']."'  id='printer_img' alt='' onclick='myClick(this)' width='20'>";
                              //echo "<img src='".base_url()."/assets/img/delete-icon.png' data-sample-id='".$value['id']."' alt='' onclick='myDelete(this)' width='20'>";
                                echo "</td>";
                              echo "</tr>";
                            }
                            ?>

                          <?php endif ?>
                        </tbody>
                      </table>
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
            <i class="fas fa-angle-up"></i>
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
                  <a class="btn btn-primary" href="login.html">Logout</a>
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

          function myDelete(d){
            var id = d.getAttribute("data-sample-id");
            var parms = {
                id : id
              };

              var r = confirm("Deseja deletar?");
              if (r == true) {
                $.ajax({
                type: "GET",
                url: "<?php echo base_url() ?>/delete_categoria",
                data: parms,
                dataType : "JSON",
                  beforeSend: function(){
                        // Show image container
                        $("#loader").show();
                      },
                      success: function(result){
                        console.log(result);
                        location.reload();

                      },
                      complete:function(data){
                      // Hide image container
                      location.reload();
                      $("#loader").hide();
                    }
                  });
              } else {
                
              }
            
          }
            function myClick(d){
              $('#msg_success').css('display','none');
              var id = d.getAttribute("data-sample-id");
              var name = d.getAttribute("data-sample-name");
              var cor = d.getAttribute("data-sample-cor");
              $('#cor_edit').val(cor);
              $('#categoria_id_edit').val(id);
              $('#categoria_nome_edit').val(name);
              $('#myModalEdit').modal('show');
            }

            $(document).ready(function(){

              $('#close_modal_edit').on('click', function () {
                location.reload();
              });
              $('#close_modal_novo').on('click', function () {
                location.reload();
              });


              $('#msg_success').css('display','none');

              $('#myform_edit').on('submit', function (e) {
                e.preventDefault();
                var parms = {
                  id_edit : $("#categoria_id_edit").val(),
                  nome_edit : $("#categoria_nome_edit").val(),
                  cor : $("#cor_edit").val()
                };
          //console.log(parms);

          $.ajax({
            type: "GET",
            url: "<?php echo base_url() ?>/update_categoria",
            data: parms,
            dataType : "JSON",
            beforeSend: function(){
                        // Show image container
                        $("#loader").show();
                      },
                      success: function(result){
                        console.log(result);
                        $('#msg_success').css('display','block');

                      },
                      complete:function(data){
                      // Hide image container
                      $("#loader").hide();
                    }
                  });
        });
              $('#myform_new').on('submit', function (e) {
                e.preventDefault();
                var parms = {
                  nome_nova : $("#categoria_nome_nova").val(),
                  cor_nova : $("#cor_nova").val(),
                };
          //console.log(parms);

          $.ajax({
            type: "GET",
            url: "<?php echo base_url() ?>/nova_categoria",
            data: parms,
            dataType : "JSON",
            beforeSend: function(){
                        // Show image container
                        $("#loader2").show();
                      },
                      success: function(result){
                        console.log(result);
                        $('#msg_success2').css('display','block');

                      },
                      complete:function(data){
                      // Hide image container
                      $("#loader2").hide();
                    }
                  });
        });

            });

          </script>

        </body>

        </html>

