<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title> - CADASTRAR - </title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-6 col-lg-6 col-md-6">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-md-12">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Cadastrar</h1>
                  </div>
                  <form class="user">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" name="nome" id="nome" aria-describedby="nomeHelp" placeholder="Nome" required>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" name="tel" id="tel" aria-describedby="nomeHelp" placeholder="Telefone" required>
                    </div>
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" name="email" id="email" aria-describedby="emailHelp" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="pass" id="pass" placeholder="Password" required>
                    </div>
                    <button class="btn btn-primary btn-user btn-block" id="submit">Enviar</button>
                    <div style="display: none;margin-top: 20px;" class="alert alert-danger" id="msg_alert" role="alert">
                      E-mail or password wrong!
                    </div>
                      <p style="text-align: center; margin-top: 15px"><a href="<?php echo base_url().'login'?>">Login</a></p>
                  </form>
                </div>
              </div>
            </div>
          </div>
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
  <script>
    $(document).ready(function() {

      $('#submit').click(function() {
        event.preventDefault();
        ajax_call();
      });

      function ajax_call() {
        var email = $('#email').val();
        var pass = $('#pass').val();
        var tel = $('#tel').val();
        var nome = $('#nome').val();

        $.ajax({
          type: "POST",
          data: {
            email: email,
            pass: pass,
            nome: nome,
            tel: tel


          },
          url: "<?php echo base_url(); ?>Login/cadastrar_novo",
          dataType: "JSON",
          beforeSend: function() {
            // Show image container
            $("#loader").show();
          },
          success: function(result) {
            //console.log(result.data);
            $.each(result.data, function(i) {
              //console.log(result.Sales[i].Id);
              console.log(result.data[i].logado);
              if (result.data[i].logado === 'sim') {
                window.location.href = "<?php echo base_url() ?>";
              } else {
                $('#msg_alert').css('display', 'block');
              }
            })
          },
          complete: function(data) {
            // Hide image container
            $("#loader").hide();
          }
        });
      }
    });
  </script>
</body>

</html>