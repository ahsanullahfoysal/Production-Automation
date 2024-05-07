<?php
session_start();
$query = $_SERVER['PHP_SELF'];
$path = pathinfo( $query );
$_SESSION['base_url'] = 'http://localhost/'.$path['dirname'];
if (isset($_SESSION['login'])) {
  header("Location: dashboard.php");
}
require_once('database_con.php');
if (isset($_POST['email'])) {
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  $match = $con->query("select * from users where email='$email' and password='$password' ")->fetch_assoc();
  if (count($match) > 0) {
    $_SESSION["login"] = true;
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["name"] = $match['name'];
    header("Location: dashboard.php");
  } else {
    header("Location: index.php");
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Production Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="signup.css">
</head>

<body class="hold-transition login-page">
<script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <script src="./plugins/jquery-validation/jquery.validate.js"></script>
  <script>
    $(document).ready(function() {
      $('#frm_valid').validate({
        rules: {
          email: "required",
          password: "required"

        },
        messages: {
          email: "Please enter Your Email ",
          password: "Please enter Your Password"
        }
      })
    })
  </script>
  <div class="login-box">
    <div class="login-logo">
      <a href="index2.html">AdminLogin</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <form action="" method="post" id="frm_valid">
          <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8 pt-1">
             
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  
</body>

</html>