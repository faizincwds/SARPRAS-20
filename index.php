<?php
session_start();
date_default_timezone_set('Asia/Jakarta');
include"config/conn.php";

$apps = mysqli_query($conn, "SELECT * FROM tb_identitas WHERE id='1' ");
$u = mysqli_fetch_assoc($apps);

$fav 		= $u['logo'];
$nm_app 	= $u['judul'];
$identitas 	= $u['instansi'];
$des 		= $u['deskripsi'];
$alamat 	= $u['alamat'];
$mail 		= $u['mail'];
$telp 		= $u['telp'];
$web 		= $u['web'];
$kodepos 	= $u['kodepos'];
$copy 		= $u['hakcipta'];
// include"template/header-web.php";

	if(isset($_GET['p'])){
		$page=(isset($_GET['p'])) ? $_GET['p']:"main";
		switch($page) {
			case'beranda':include"beranda.php";break;
			case'forget':include"forget.php";break;
			case'logout':include"logout.php";break;
		}
	}elseif(isset($_GET['r'])){
		include"reset.php";
	}else{
		include"beranda.php";
	}

// include"template/footer-web.php";
?>