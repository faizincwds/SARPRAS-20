<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> <?php echo $nm_app ?> </title>
  <!-- Tell the browser to be responsive to screen width --><!-- 
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport"> -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="icon" href="../assets/img/logo/<?php echo $fav ?>">
  <meta name="description" content="<?php echo $des ?>"/>
  <meta name="keywords" content="sarpras, aplikasi sarpras, sim sarpras, stimik Tunas bangsa" />
  <meta name="author" content="Faizin Ahmad"/>
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../assets/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../assets/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../assets/dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../assets/morris.js/morris.css">
  <link rel="stylesheet" href="../assets/datatables/css/dataTables.bootstrap.min.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../assets/bootstrap-datepicker/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <link rel="stylesheet" href="../assets/ckeditor/ckeditor.css">

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="./" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>IM</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">SIM <b>SARPRAS</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="../assets/#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class=" user user-menu">
            <a href="#"  title="Login as Administrator">
              <i class="fa fa-user"> </i>  
              <span >Hai, 
                    <?php 
                        $lvl = $_SESSION['nama_user'];
                          echo $lvl;
                      ?>
                        
                      </span> 
            </a>
          </li>

          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="../logout"><span> Logout </span> <i class="fa fa-sign-out"></i></a>
          </li>

        </ul>
      </div>


    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->