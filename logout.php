<?php
$sesi = $_SESSION['login_user'];
$date = date('Y-m-d H:i:s');
$qry = mysqli_query($conn,"UPDATE tb_user SET log_keluar='$date' WHERE username = '$sesi' ");

if(session_destroy()) // Menghapus Sessions
{
echo '<script language="javascript">document.location="./";</script>';
}
?>