<?php
$lvl = $_SESSION['level_user'];
                        $qry = "SELECT * FROM tb_level 
                                INNER JOIN tb_user
                                ON tb_level.level=tb_user.level WHERE tb_level.level='$lvl' ";
                        $lv = mysqli_query($conn,$qry);
                        $r = mysqli_fetch_assoc($lv);
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">

<!-- Default box -->
      <div class="box" style="border-top:none; box-shadow:0 1px 5px 0px rgba(0,0,0,0.1);">
        <div class="box-body">
          <h3>Konfigurasi Profil</h3><hr>
          <div class="col-md-4">
              <div class="box box-primary">
                <div class="box-body box-profile">
                  <div class="btn-group  pull-right">
                <a href="#" data-toggle="dropdown" aria-expanded="true"> <i class="fa fa-camera text-primary"></i></a>
                  <ul class="dropdown-menu" role="menu" style="padding: 10px">
                    <form action="" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name="id" value="<?php echo $r['id'] ?>">
                    <li>
                      <div class="form-group">
                    <label>Upload your image</label>
                    <input type="file" name="gbr" title="Upload foto">
                  </div>
                </li>
                <li style="font-size: 7pt">Max. Size your upload 1Mb.</li><br>
                    <li><button class="form-control" type="submit" name="upd" > <i class="fa fa-upload"></i> Update </button></li>
                  </form>
                  </ul>
                </div>
                <?php if(empty($r['photo'])){ ?>
                   <img class="profile-user-img img-responsive img-circle" src="../assets/dist/img/user2-160x160.jpg" alt="<?php echo $_SESSION['nama_user']; ?>">
                  <?php }else{ ?>
                         <img class="profile-user-img img-responsive img-circle" src="../assets/img/profil/<?php echo $r['photo'] ?>" alt="<?php echo $_SESSION['nama_user']; ?>">
                      <?php } ?>
                   
                  <h3 class="profile-username text-center">
                    <?php echo $_SESSION['nama_user']; ?>
                  </h3>
<a href="#" data-toggle="modal" data-target="#Photo" title="Edit Profil"><i class="fa fa-pencil text-primary pull-right"></i> </a> 
                  <p class="text-muted text-center">
                    <?php  echo $r['nm_level']; ?>
                  </p>

                  <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      <b>Email</b> <font class="pull-right"> <?php echo $r['email'] ?> </font>  
                    </li>
                    <li class="list-group-item">
                      <b>Username</b> <font class="pull-right"> <?php echo $r['username'] ?> </font>
                    </li>
                    <li class="list-group-item">
                      <b>Password</b> <font class="pull-right"> ***** </font>
                    </li>
                  </ul>
<?php
if(isset($_POST['upd'])){
// $idUsr =  $_SESSION['id_user'];
// $users = mysqli_query($conn, "SELECT * FROM tb_identitas WHERE id='$idUsr' ");
// $row = mysqli_fetch_assoc($users);
  //Lokasji file sementara
  $lokasi_file  = $_FILES['gbr']['tmp_name'];
  $nama_file    = $_FILES['gbr']['name'];
  //tentukan folder untuk menyimpan file
  $nama_file_unik = date("YmdHis").$nama_file;
  $folder = "../assets/img/profil/$nama_file_unik";
  

  //Hapus ketika di Update
  $icon   = $r['photo'];
  $hps  = "../assets/img/profil/$icon";
  $tgl = date('Y-m-d'); 

  if(empty($icon)){
    if(move_uploaded_file($lokasi_file,"$folder")){
    $ok= mysqli_query($conn, "UPDATE tb_user SET photo='$nama_file_unik' WHERE id='$r[id]' ");
    
      if($ok){
        echo("<meta http-equiv='refresh' content='0'>"); //Refresh by HTTP 'meta'
      }else{
        echo "<script>Oops! Logo Gagal di Update. Coba lagi nanti</script>";
      }
    
    }
  }else{
    if(move_uploaded_file($lokasi_file,"$folder")){
    $ok= mysqli_query($conn, "UPDATE tb_user SET photo='$nama_file_unik' WHERE id='$r[id]' ");
    
      if($ok){
        unlink("$hps");//unlink berfungsi untuk menghapus gambar yang berada didalam direktori gambar
        echo("<meta http-equiv='refresh' content='0'>"); //Refresh by HTTP 'meta'

      }else{
        echo "<script>Oops! Logo Gagal di Update. Coba lagi nanti</script>";
      }
    
    }
  }
  
    if(move_uploaded_file($lokasi_file,"$folder")){
    $ok= mysqli_query($conn, "UPDATE tb_user SET photo='$nama_file_unik' WHERE id='$r[id]' ");
    
      if($ok){
        unlink("$hps");//unlink berfungsi untuk menghapus gambar yang berada didalam direktori gambar
        //echo("<meta http-equiv='refresh' content='0'>"); //Refresh by HTTP 'meta'

      }else{
        echo "<script>Oops! Logo Gagal di Update. Coba lagi nanti</script>";
      }
    
    }

}


if(isset($_POST['save'])){
  $id_post   = $_POST['id'];
  $nama   = $_POST['nama'];
  $email   = $_POST['email'];
  $username   = $_POST['username'];
  $password   = md5($_POST['password']);

  if (!empty($password)) {
    $update = mysqli_query($conn, "UPDATE tb_user SET nama='$nama', email='$email', username='$username', password='$password' WHERE id='$id_post' ");
      if ($update) {
        $_SESSION['login_user'] = $username; //update new session
        $_SESSION['nama_user'] = $nama;
        echo("<meta http-equiv='refresh' content='0'>"); //Refresh by HTTP 'meta'
      }else{
        echo "MAAF TERJADI KESALAHAN SAAT UPPDATE PROFIL";
      }
  }else{
  $update = mysqli_query($conn, "UPDATE tb_user SET nama='$nama', email='$email', username='$username' WHERE id='$id_post' ");
    if ($update) {
        $_SESSION['login_user'] = $username; //update new session
        $_SESSION['nama_user'] = $nama;
        echo("<meta http-equiv='refresh' content='0'>"); //Refresh by HTTP 'meta'
      }else{
        echo "MAAF TERJADI KESALAHAN SAAT UPPDATE PROFIL";
      }
  }
}
?>
                </div>
                <!-- /.box-body -->
              </div>
            </div>

        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>

  <div class="modal fade in md-2" id="Photo">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Ubah Profil</h4>
              </div>
              <div class="modal-body">

                <form action="" method="POST">
                  <input type="hidden" name="id" value="<?php echo $r['id'] ?>">
                  
                  <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input class="form-control" type="text" name="nama" value="<?php echo $r['nama'] ?>">
                  </div>
                  <div class="form-group">
                    <label>Level</label>
                    <input class="form-control" type="text" name="level" value="<?php echo $r['nm_level'] ?>" disabled="disabled">
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" type="email" name="email" value="<?php echo $r['email'] ?>">
                  </div>
                  <div class="form-group">
                    <label>Username</label>
                    <input class="form-control" type="username" name="username" value="<?php echo $r['username'] ?>">
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" type="password" name="password" placeholder="kosongkan bila tak ingin di ubah">
                  </div>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="submit" name="save" class="btn btn-sm btn-primary">Simpan</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
