<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ADVentas | www.incanatoit.com</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.css">
   
    <!-- Theme style -->
    <link rel="stylesheet" href="css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="blue.css">

     <script type="text/javascript" src="js/jquery-3.2.1.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <script>
  function iniciar_sesion()
      {
        if ($('#email').val() == "") 
          {
            $("#email").focus();
            $("#respuesta").html("<div class='alert alert-warning'>Debe ingresar un email.</div>");
          }
        else if ($('#password').val() == "" ) 
          {
            $("#password").focus();
            $("#respuesta").html("<div class='alert alert-warning'>Debe escribir una contraseña.</div>");
          }
        else
          {
        $.ajax({
            url: '../controllers/UsuarioLogin.php',
            type: 'POST',
            timeout: 100000,
            data: $("#formulario").serialize(),
            beforeSend: function(){
              $('#email').attr('disabled', true);
              $('#password').attr('disabled', true);
              $('#cancelar').attr('disabled', true);
              $("#respuesta").html("<div class='alert alert-info'>Validando datos, por favor espere...</div>");
              },
            error: function(){
              $('#email').attr('disabled', false);
              $('#password').attr('disabled', false);
              $('#cancelar').attr('disabled', false);
              $("#respuesta").html("<div class='alert alert-danger'>Ha ocurrido un error, por favor intentalo nuevamente. Si este mensaje persiste, comunicate con soporte.</div>");
              },
            success: function(resultado){
              if( resultado == 1 )    
                {
                  $("#respuesta").html("<div class='alert alert-success'>Datos verificados, estamos redirigiendo a la página principal.</div>");
                  window.location.href = "./Home.php";
                }                    
              else 
                {
                  $("#respuesta").html(resultado);
                  $('#email').attr('disabled', false);
                  $('#password').attr('disabled', false);
                  $('#cancelar').attr('disabled', false);
                }
              }
            })
          }
    }
    $(document).ready(function(){
        $("#iniciar").click(function(){
        iniciar_sesion();
        });
    });
</script>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <h1>Caridad Y Santa, C.A.</h1>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Ingrese sus datos de Acceso</p>
        <form action="javascript:void(0);" id="formulario">
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email" name="email" id="email"> 
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" name="password" id="password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            
            <div class="col-xs-12 text-center">
              <button type="submit" id="iniciar" class="btn btn-primary btn-block btn-flat">Ingresar</button><br>
            </div>
            <div class="col-xs-12 text-center">
              <a href="#">Olvidé mi password</a><br><br>
            </div>
            <div class="col-xs-12 text-center">
              <p id="respuesta">
            </div>
          </div>
        </form>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
  </body>
</html>
