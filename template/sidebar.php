
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- /.search form -->
      <div class="user-panel">
        <div class="pull-left image">
          <?php 
          $idUsr =  $_SESSION['id_user'];
          $users = mysqli_query($conn, "SELECT * FROM tb_user WHERE id='$idUsr' ");
          $row = mysqli_fetch_assoc($users);
          if(empty($row['photo'])){ ?>
          <img src="../assets/dist/img/user2-160x160.jpg" class="img-circle" alt="$_SESSION['nama_user'];">
        <?php }else{ ?>
          <img src="../assets/img/profil/<?php echo $row['photo'] ?>" class="img-circle" alt="<?php echo $_SESSION['nama_user']; ?>">
        <?php } ?>
        </div>
        <div class="pull-left info">
         <p><a href="./profil" title="Edit Profil"> <?php echo $_SESSION['nama_user']; ?> <i class="fa fa-gears pull-right"></i> </a>  </p>
          <?php 
            $lvl = $_SESSION['level_user'];
            $lv = mysqli_query($conn,"SELECT * FROM tb_level WHERE level='$lvl' ");
            $r = mysqli_fetch_assoc($lv);
              echo "<span style='font-size:8pt;color:#b8c7ce;'>Level : $r[nm_level] </span>";
          ?>
          
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>

        <?php
          $session = $_SESSION['login_user'];
          $sql = mysqli_query($conn, "SELECT * FROM tb_user WHERE username='$session' ");
          $cek = mysqli_fetch_assoc($sql);
          $level = $cek['level'];

          if ($level == 1) { ?> <!----Admin--->
              <li class="<?php if($_GET['p']==''){echo"active";} ?>"><a href="./" ><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
              <li class="<?php if($_GET['p']=='pengguna'){echo"active";} ?>"><a href="./pengguna"><i class="fa fa-users"></i> <span>Kelola Pengguna</span></a></li>
              <li class="<?php if($_GET['p']=='setting'){echo"active";} ?>"><a href="./setting"><i class="fa fa-home"></i> <span>Identitas App</span></a></li>
          
          <?php }elseif($level == 2){ ?>  <!----Ketua--->
              <li class="<?php if($_GET['p']==''){echo"active";} ?>"><a href="./" ><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
              <li class="<?php if($_GET['p']=='approval'){echo"active";} ?>" ><a href="./approval"><i class="fa fa-check-circle"></i> <span>Persetujuan</span></a></li>
              <li class="<?php if($_GET['p']=='riwayat'){echo"active";} ?>"><a href="./riwayat"><i class="fa fa-history"></i> <span> Riwayat </span></a></li>
              <!-- <li class="<?php //if($_GET['p']=='laporan'){echo"active";} ?>"><a href="./laporan"><i class="fa fa-line-chart"></i> <span>Laporan Sarpras</span></a></li> -->

          <?php }elseif($level == 3){ ?> <!----SARPRAS--->
              <li class="<?php if($_GET['p']==''){echo"active";} ?>"><a href="./"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
              <li class="<?php if($_GET['p']=='request'){echo"active";} ?>"><a href="./request"><i class="fa fa-folder-open"></i> <span>Pengajuan Alat</span></a></li>
              <li class="<?php if($_GET['p']=='items'){echo"active";} ?>"><a href="./items"><i class="fa fa-inbox"></i> <span> Barang Masuk </span></a></li>
              <li class="<?php if($_GET['p']=='stock'){echo"active";} ?>"><a href="./stock"><i class="fa fa-stack-overflow"></i> <span> Stock Barang</span></a></li>
              <li class="<?php if($_GET['p']=='riwayat'){echo"active";} ?>"><a href="./riwayat"><i class="fa fa-history"></i> <span> Riwayat </span></a></li>
              <li class="<?php if($_GET['p']=='broken'){echo"active";} ?>"><a href="./broken"><i class="fa fa-chain-broken"></i> <span> Kerusakan Barang</span></a></li>
              <li class="<?php if($_GET['p']=='hide'){echo"active";} ?>"><a href="./hide"><i class="fa fa-eye-slash"></i> <span> Kehilangan Barang</span></a></li>
              <!-- <li class="<?php //if($_GET['p']=='laporan'){echo"active";} ?>"><a href="./report"><i class="fa fa-line-chart"></i> <span>Laporan Inventaris</span></a></li> -->

          <?php }else{ ?> <!----umum/pembelian--->

               <li class="<?php if($_GET['p']==''){echo"active";} ?>"><a href="./"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
              <li class="<?php if($_GET['p']=='data-order'){echo"active";} ?>"><a href="./data-order"><i class="fa fa-stack-overflow"></i> <span>Keranjang Belanja</span></a></li>
              <li class="<?php if($_GET['p']=='order'){echo"active";} ?>"><a href="./order"><i class="fa fa-shopping-cart"></i> <span>Pesanan</span></a></li>
             <li class="<?php if($_GET['p']=='histori'){echo"active";} ?>"><a href="./histori"><i class="fa fa-history"></i> <span> Riwayat Pembelian</span></a></li>

          <?php } ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
