<?php

  if(isset($_GET['t'])){
    $token  = $_GET['t'];
    
    $sql = mysqli_query($conn, "SELECT * FROM tb_user WHERE lupa_pwd='$token' ");
    $ada = mysqli_num_rows($sql);
    $r = mysqli_fetch_assoc($sql);
    $idU = $r['id'];
    
    if($ada > 0){
      $n = 0;
      mysqli_query($conn, "UPDATE tb_user SET lupa_pwd='$n' WHERE id='$idU' " );
      
      $alert="alert alert-success";
      $Pesan="<center><b>Reset Passord Berhasil!!</b> <br> Silahkan login </center>";
      
    }else{
      $alert="alert alert-warning";
      $pesan="<center><b>Gagal Reset Password!!</b><br> Silahkan request reset password lagi atau hubungi Admin.</center>";
    }
  }

?>

<?php
if(isset($_POST['login'])){

  $date = date('Y-m-d H:i:s');

  $username = $_POST['user'];
  $password = md5($_POST['pwd']);

    $login = mysqli_query($conn,"SELECT * FROM tb_user WHERE username = '$username' && password = '$password' ");
    $ada   = mysqli_num_rows($login);
    $ls = mysqli_fetch_assoc($login);

    if ($ada > 0) {
        $_SESSION['login_user'] = $username; //create session
        $_SESSION['level_user'] = $ls['level']; //create session
        $_SESSION['nama_user'] = $ls['nama']; //create session
        $_SESSION['id_user'] = $ls['id']; //create session
        $qry = mysqli_query($conn,"UPDATE tb_user SET log_masuk='$date' WHERE username = '$username' ");

        echo "<script> window.location='./account';</script>";
    }elseif ($username =='' AND $password =='') {
        $alert  = "alert alert-warning";
        $pesan  = " <b>Terjadi Kesalahan!</b><br> Field username dan password belum diisi.";
    }elseif (empty($username)) {
        $alert  = "alert alert-warning";
        $pesan  = " <b>Terjadi Kesalahan!</b><br> Field username belum diisi."; 
    }elseif (empty($password)) {
        $alert  = "alert alert-warning";
        $pesan  = " <b>Terjadi Kesalahan!</b><br> Field password belum diisi.";          
    }else{
        $alert  = "alert alert-danger";
        $pesan  = " <b>Terjadi Kesalahan!</b><br> Username atau password tidak benar."; 
    }
}
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $nm_app ?></title>
  <link rel="icon" href="./assets/img/logo/<?php echo $fav ?>">
  <meta name="description" content="<?php echo $des ?>"/>
  <meta name="keywords" content="sarpras, aplikasi sarpras, sim sarpras, stimik Tunas bangsa" />
  <meta name="author" content="Faizin Ahmad"/>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="./assets/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./assets/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="./assets/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="./assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="./assets/iCheck/square/blue.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page" style="height: auto">
<div class="login-box">
  <div class="login-logo">
    <b>SIM</b> SARPRAS
  </div>

 <?php 
        if(isset($_GET['t'])){ 
    ?>

    <div class="<?php echo $alert ?>" style="padding:6px; font-size: 9pt">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
     <?php echo $pesan ?>
    </div>
    <?php } ?>

  <!-- /.login-logo -->
  <div class="login-box-body">
    <img src="./assets/img/tbu.png" class="img-responsive" alt="SIM SARPRAS" style="width: 100px; margin: auto">
    <h4 class="login-box-msg" style="padding-bottom: 5px;padding-top: 20px"><?php echo $identitas ?></h4>
    <p class="login-box-msg" style="font-family: cursive;">Aplikasi Sarana Prasarana</p>
    <?php 
        if(isset($_POST['login'])){ 
    ?>

    <div class="<?php echo $alert ?>" style="padding:6px; font-size: 9pt">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
     <?php echo $pesan ?>
    </div>
    <?php } ?>

   


    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="user"class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="pwd" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
        <div class="form-group has-feedback">
          <button type="submit" name="login" class="btn btn-primary btn-block btn-flat"><i class="fa fa-sign-in"></i> Sign In</button>
        </div>
    <a href="./forget" style="float:right;"> Forgot your password?</a><br>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

</body>
<!-- jQuery 3 -->
<script src="./assets/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="./assets/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="./assets/plugins/iCheck/icheck.min.js"></script>

</html>