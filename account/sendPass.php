<?php
if ($_SESSION['level_user'] != 1) {
	echo"<script>alert('Upss!!! Ngga boleh jail ya :) ')</script>";
	echo"<script>location='./'</script>";
}
?>

<?php
if(isset($_POST['atu'])){
$id_daftar 	= $_POST['atu'];
$username 	= $_POST['username'];
$password 	= $_POST['password'];
$email 		= $_POST['email'];

$th = date('Y');
			
			$links = "./?p=verif&id=$id_daftar";
			
			$body= "
			Halo $nama_pmb,<br>
			Silakan klik link di bawah untuk Aktifkan akun Anda.<br><br>
			
			$links
			<br><br>

			<h3>Silahkan gunakan informasi berikut untuk login ke Portal SIM SARPRAS Anda</h3> <br>

			Email: $email <br/>
			ID Pendaftaran : $id_daftar <br/>
			";
			
				function send_mail($to, $body, $subject){
				
				require '../PHPMailer/PHPMailerAutoload.php';
			 
					$mail = new PHPMailer;
					$mail->SMTPDebug = 2;
					$mail->isSMTP();
					$mail->Host = 'mail.stit-tunasbangsa.ac.id';
					$mail->SMTPAuth = true;
					$mail->Username = 'pmb@stit-tunasbangsa.ac.id';
					$mail->Password = 'adminwebstit1234';
					$mail->SMTPSecure = 'tls';
					$mail->Port = 587;
					$mail->SetFrom('pmb@stit-tunasbangsa.ac.id','Password Your Account SIM SARPRAS');
					$mail->addAddress($to);
					$mail->addReplyTo('faizincwds92@gmail.com', 'Reply');
					$mail->isHTML(true);
					$mail->Subject = $subject;
					$mail->Body    = $body;
				

					if(!$mail->send()){
						$berhasil="<b>Send password success </b>";
						$class="alert alert-success alert-dismissible";
						
					}else{
						$berhasil="<b>Send password faild</b>";
						$class="alert alert-danger alert-dismissible";
					}
				}
				$to = $email; //email tujuan
				$subject = "Notification SIM SARPRAS"; // subject email
				$body = " $body ";
				send_mail($to, $body, $subject);

}

?>