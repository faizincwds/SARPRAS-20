<?php
include'config/conn.php';
  
if(isset($_POST['lupa'])){
 // $email = $_POST['email'];
  $email = mysqli_real_escape_string($conn, $_POST['email']);

  function acak($panjang){
      $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789';
      $string   = '';
      
      for ($i = 0; $i < $panjang; $i++) {
        $pos   = rand(0, strlen($karakter)-1);
        $string .= $karakter{$pos};
      }
      
      return $string;
    }

    $checkUser = mysqli_query($conn, "SELECT * FROM tb_user WHERE email='$email' ");
    $r = mysqli_fetch_assoc($checkUser);
    $idUsr = $r['id'];
    $token = acak(100);

if($r['email'] == $email){

          $th = date('Y');
          $links = "https://$web/?r=$token";
          
          $body= " 
            <h2> Reset Password </h2> <br>
            Untuk mengganti password silahkan klik link berikut: 
            <br><br>

            <center>
            <b> 
            <a href='$links'><button style='padding:8px; color:#fff; background:red; border:none; border-radius:10px;'>GANTI PASSWORD</button></a>
            </b> 
            </center>

            <br><br>
            Jika link di atas tidak bekerja, copy dan paste url berikut di browser anda:
            <br><br>
            $links
            <br><br>
            Jika anda tidak berniat mengganti password, jangan klik link di atas dan abaikan email ini.
            <br><br><br>

            Terima kasih, <br> 
            Admin
            <br><br>
            &copy; $th <a href='https://$web'>SIM SARPRAS </a>. Seluruh hak cipta.
          ";

          function send_mail($to, $body, $subject){
            
            require 'PHPMailer/PHPMailerAutoload.php';
           
              $mail = new PHPMailer;

              //$mail->SMTPDebug = 2;
              $mail->isSMTP();
              $mail->Host = 'smtp.gmail.com';
              $mail->SMTPAuth = true;
              $mail->Username = 'faizincwds92@gmail.com';
              $mail->Password = 'sanggauF12';
              $mail->SMTPSecure = 'tls';
              $mail->Port = 587;
              $mail->SetFrom('faizincwds92@gmail.com','SIM SARPRAS');
              $mail->addAddress($to);
              $mail->addReplyTo('faizincwds92@gmail.com', 'no-reply');
              $mail->isHTML(true);
              $mail->Subject = $subject;
              $mail->Body    = $body;

              if(!$mail->send()) {
                return 'fail';
              } else {
                return 'success';
              }

            }

              $to       = $email; //email tujuan
              $subject  = "[no-reply] Recovery Password"; // subject email
              $body     = " $body ";
              $send_mail = send_mail($to, $body, $subject);


        if($send_mail == 'success'){
            $query = mysqli_query($conn, "UPDATE tb_user SET lupa_pwd='$token' WHERE id='$idUsr' ");

            if($query){
                 $msg = 'A mail with recovery instruction has sent to your email.';
                 $msgclass = 'alert alert-success';
              }else{
                $msg = 'There is something wrong.';
                $msgclass = 'alert alert-danger';
              }


        }else{
            $msg = 'There is something wrong.';
            $msgclass = 'alert alert-danger';
        }
    
  }else{
    $msg = "This email doesn't exist in our database.";
    $msgclass = 'alert alert-danger';
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
    <img src="./assets/img/tbu.png" class="img-responsive" alt="<?php echo $nm_app ?>" style="width: 100px; margin: auto">
    <h4 class="login-box-msg" style="padding-bottom: 5px;padding-top: 20px">Reset your password</h4>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
                <?php if(isset($msg)) {?>
                  <div class="<?php echo $msgclass; ?>" style="padding:5px;"><?php echo $msg; ?></div>
                <?php } ?>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <label>Enter your email account's verified email address and we will send you a password reset link.</label>
        <input type="email" name="email"class="form-control" placeholder="Enter your email address" required="@">
      </div>
        <div class="form-group has-feedback">
          <button type="submit" name="lupa" class="btn btn-success btn-block btn-flat"><i class="fa fa-send"></i> Send password reset to email</button>
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
