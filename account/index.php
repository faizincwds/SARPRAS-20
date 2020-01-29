<?php
session_start();
include"../config/conn.php";
date_default_timezone_set('Asia/Jakarta');

	if (empty($_SESSION['login_user'] OR $_SESSION['login_admin'])) {
		header('location:../');
		}
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


include"../template/header.php";
include"../template/sidebar.php";

	if(isset($_GET['p'])){
		$page=(isset($_GET['p'])) ? $_GET['p']:"main";
		switch($page) {
			case'beranda':include"beranda.php";break;
			case'pengguna':include"pengguna.php";break;
			case'riwayat':include"riwayat.php";break;
			case'setting':include"setting.php";break;
			case'profil':include"profil.php";break;

			case'request':include"manajer/request.php";break;
			case'stock':include"manajer/stock-barang.php";break;
			case'items':include"manajer/barang-baru.php";break;
			case'broken':include"manajer/rusak.php";break;
			case'hide':include"manajer/hilang.php";break;
			//case'report':include"manajer/laporan.php";break;

			case'approval':include"ketua/approval.php";break;
			//case'laporan':include"ketua/laporan.php";break;

			case'histori':include"umum/histori.php";break;
			case'data-order':include"umum/data-order.php";break;
			case'order':include"umum/order.php";break;
		}
	}else{
		include"beranda.php";
	}


include"../template/footer.php";
?>