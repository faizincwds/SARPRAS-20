<?php
    $token  = $_GET['r'];
    $sql = mysqli_query($conn,"SELECT * FROM tb_user WHERE lupa_pwd='$token' ");
    $ada = mysqli_num_rows($sql);
    $r = mysqli_fetch_assoc($sql);
    $idU = $r['id'];

  if($ada > 0){
?>

<?php
if(isset($_POST['upd'])){
  $email  = $_POST['email'];
  $pwd  = $_POST['pwd'];
  $cpwd = $_POST['cpwd'];
  $cpwd_md5 = md5($cpwd);
  $id   = $_POST['id'];

  if($pwd == $cpwd){
    $cek = mysqli_query($conn, "SELECT * FROM tb_user WHERE id='$id' AND email='$email' ");
    $row = mysqli_num_rows($cek);
    
    if($row > 0){
        $save = mysqli_query($conn, "UPDATE tb_user SET password='$cpwd_md5' WHERE id='$id' ");
          if($save){
              $n = 0;
              $reset_lupa = mysqli_query($conn, "UPDATE tb_user SET lupa_pwd='$n' WHERE id='$id' " );
              $class="alert alert-success";
              $pesan="Password anda berhasil di ganti. Silahkan login melalui link dibawah.";
            }else{
              $class="alert alert-warning";
              $pesan="<center><h2>ERROR 404!!!</h2></center>";
            }
    }else{
        $class="alert alert-danger";
        $pesan="<center><h2>Maaf data anda tidak terdeteksi didalam database.</h2></center>";
    }

  }else{
        $class="alert alert-warning";
        $pesan="Password anda tidak sama!";
  }

}
?>

<?php } ?>

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
    <h3 class="login-box-msg" style="padding-bottom: 5px;padding-top: 20px">Create your password</h3><br>

  <!-- /.login-logo -->
  <div class="login-box-body">
                  <div class="<?php if(isset($class)){ echo $class; } ?>" style="padding:5px;"><?php if(isset($pesan)){ echo $pesan; } ?></div>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <label>Your email account</label>
        <input type="hidden" name="id" value="<?php echo $idU ?>" class="form-control" >
        <input type="email" name="email"class="form-control" placeholder="Your email account" required="@" >
      </div>
      <div class="form-group has-feedback">
        <label>New password</label>
        <input type="text" name="pwd"class="form-control" placeholder="New password" >
      </div>
      <div class="form-group has-feedback">
        <label>Confirm new password</label>
        <input type="text" name="cpwd"class="form-control" placeholder="Confirm new password" >
      </div>
        <div class="form-group has-feedback">
          <button type="submit" name="upd" class="btn btn-success btn-block btn-flat"> Simpan </button>
        </div>

    [<a href="./">Login</a>]<br>
    </form>
  </div>
  <!-- /.login-box-body -->
  <p class="login-box-msg" style="padding-bottom: 5px;padding-top: 20px">Copyright &copy; <?php echo $copy ?></p>
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
