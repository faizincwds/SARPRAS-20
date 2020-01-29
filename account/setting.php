<?php
if ($_SESSION['level_user'] != 1) {
  echo"<script>alert('Upss!!! Ngga boleh jail ya :) ')</script>";
  echo"<script>location='./'</script>";
}
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">

<!-- Default box -->
      <div class="box" style="border-top:none; box-shadow:0 1px 5px 0px rgba(0,0,0,0.1);">
        <div class="box-header with-border">
        <div class="box-body">
          <h1>Setting</h1><hr>

            <div class="col-md-5 pull-left">
              <div class="box" style="border-top:none; box-shadow:0 1px 5px 0px rgba(0,0,0,0.1);">
                <div class="box-header with-border">
                  <h3 class="box-title">Kategori</h3>
                   
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="box-body">

                  <form class="form-inline" id='form-delete' method="post" action="">
                    <button type="button" class="btn btn-xs btn-primary btn-flat" data-toggle="modal" data-target="#addUser">Tambah</button> 

                    <button type="button" name="del" id='del-admin' class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i> Hapus</button>

<i class="fa fa-info-circle pull-right" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"> Instruksi</i>
                    <br>
                  <br>

                    <table class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Select</th>
                        <th>ID</th>
                        <th>Kategori Level</th>
                      </tr>
                    </thead>
                    <tbody>
<?php 
if (isset($_POST['cateID'])) {
  $id     = $_POST['id'];
  $level  = $_POST['cateID'];
  $user   = mysqli_query($conn,"UPDATE tb_level SET level='$level' WHERE id='$id' ");

  if ($user) {
    //echo "sukses";
    echo("<meta http-equiv='refresh' content='0'>"); //Refresh by HTTP 'meta'
  }else{
    echo "gagal";
  }
}

if (isset($_POST['codeId'])) {
  $id   = $_POST['codeId'];
  $hps  = mysqli_query($conn,"DELETE FROM tb_level WHERE id IN(".implode(",", $id).") ");//muti delete
   echo("<meta http-equiv='refresh' content='0'>"); //Refresh by HTTP 'meta'
}


$tb = mysqli_query($conn,"SELECT * FROM tb_level ORDER BY level ASC");

while($r = mysqli_fetch_assoc($tb)){
$lvl = $r['level'];
?>
                      <tr>
                        <td><input type='checkbox' class='check-item' name='codeId[]' value='<?php echo $r['id']; ?>'></td>
                      </form>
                      <td>
                              <?php 
                                $qry = mysqli_query($conn,"SELECT * FROM tb_level");
                                $ro = mysqli_fetch_assoc($qry);
                              ?>
                              <option value="<?php echo $r['level'] ?>" <?php if($r['level']) { echo "selected='selected'";} ?> > 
                                <?php echo $r['level']; ?> 
                              
                        </td>
                        <td><?php echo $r['nm_level'] ?></td>
                        
                      </tr>
<?php 
}
?>
                    </tbody>
                    </table>


<div class="collapse" id="collapseExample">
  <div class="well">
    <p>Catatan:</p>
          <p>
          ID 1 = untuk Admin<br>
          ID 2 = untuk Ketua/Pmpinan<br>
          ID 4 = untuk Gudang/Manajer/Ka.Sarpras<br>
          ID 5 = untuk Pembelian/Umum/Administrasi
          </p>
  </div>
</div> 
                    
                </div>
                <!-- /.box-body -->


              </div>
            </div>
            <!-- /.box -->

<?php

$app = mysqli_query($conn, "SELECT * FROM tb_identitas WHERE id='1' ");
$q = mysqli_fetch_assoc($app);

?>

        <div class="col-md-7 pull-left">
            
            <div class="box" style="border-top:none; box-shadow:0 1px 5px 0px rgba(0,0,0,0.1);">
            <div class="box-header with-border">
              <h3 class="box-title">Identitas Aplikasi</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form class="form-inline" id='form-delete' method="post" action="">
                    <button type="button" class="btn btn-xs btn-primary btn-flat " data-toggle="modal" data-target="#addUpdate"><i class="fa fa-pencil"></i> Edit Identitas</button>

                    <button type="button" class="btn btn-xs btn-success btn-flat " data-toggle="modal" data-target="#addLogo"><i class="fa fa-upload"></i> Edit Logo</button>
              </form><br>
              <table id="tabel1" class="table table-bordered table-hover">
                  <tr>
                    <td style="min-width: 100px">Logo</td>
                    <td> 
<?php 
                        $idUsr =  $_SESSION['id_user'];
                        $users = mysqli_query($conn, "SELECT * FROM tb_identitas WHERE id='$idUsr' ");
                        $row = mysqli_fetch_assoc($users);
if (isset($_POST['uptlogo'])){
  //Lokasji file sementara
  $lokasi_file  = $_FILES['logo']['tmp_name'];
  $nama_file    = $_FILES['logo']['name'];
  //tentukan folder untuk menyimpan file
  $nama_file_unik = date("YmdHis").$nama_file;
  $folder = "../assets/img/logo/$nama_file_unik";
  

  //Hapus ketika di Update
  $icon   = $row['logo'];
  $hps  = "../assets/img/logo/$icon";
  $tgl = date('Y-m-d'); 
  
  if(empty($icon)){
    if(move_uploaded_file($lokasi_file,"$folder")){
    $ok= mysqli_query($conn, "UPDATE tb_identitas SET logo='$nama_file_unik' WHERE id='$idUsr' ");
    
      if($ok){
        //unlink("$hps");//unlink berfungsi untuk menghapus gambar yang berada didalam direktori gambar
        echo("<meta http-equiv='refresh' content='0'>"); //Refresh by HTTP 'meta'

      }else{
        echo "<script>Oops! Image Gagal di Update. Max.Size: 1MB</script>";
      }
    
    }
  }else{
    if(move_uploaded_file($lokasi_file,"$folder")){
    $ok= mysqli_query($conn, "UPDATE tb_identitas SET logo='$nama_file_unik' WHERE id='$idUsr' ");
    
      if($ok){
        unlink("$hps");//unlink berfungsi untuk menghapus gambar yang berada didalam direktori gambar
        echo("<meta http-equiv='refresh' content='0'>"); //Refresh by HTTP 'meta'

      }else{
        echo "<script>Oops! Image Gagal di Update. Max.Size: 1MB</script>";
      }
    
    }
  }

}

                        
                        if(empty($row['logo'])){ ?>
                        <img src="../assets/img/photo/nofoto.png" class="img-circle" style="width: 100px" alt="$_SESSION['nama_user'];">
                      <?php }else{ ?>
                        <img src="../assets/img/logo/<?php echo $row['logo'] ?>" style="width: 100px" alt="<?php echo $_SESSION['nama_user']; ?>">
                      <?php } ?>
                       </td>
                  </tr>
                  <tr>
                    <td> Identitas App </td>
                    <td> <?php echo $q['judul']; ?> </td>
                  </tr>
                  <tr>
                    <td>Nama Instansi</td>
                    <td> <?php echo $q['instansi']; ?> </td>
                  </tr>
                  <tr>
                    <td>Meta Deskripsi</td>
                    <td> <?php echo $q['deskripsi']; ?> </td>
                  </tr>
                  <tr>
                    <td>Alamat</td>
                    <td> <?php echo $q['alamat']; ?> </td>
                  </tr>
                  <tr>
                    <td>Telpone</td>
                    <td> <?php echo $q['telp']; ?> </td>
                  </tr>
                  <tr>
                    <td>Email</td>
                    <td> <?php echo $q['mail']; ?> </td>
                  </tr>
                  <tr>
                    <td>Website</td>
                    <td> <?php echo $q['web']; ?> </td>
                  </tr>
                  <tr>
                    <td>Kode Pos</td>
                    <td> <?php echo $q['kodepos']; ?> </td>
                  </tr>
                  <tr>
                    <td>Copyright</td>
                    <td> <?php echo $q['hakcipta']; ?> </td>
                  </tr>

                  
              </table>
            </div>
            <!-- /.box-body -->
          </div>

        </div>


<?php

if (isset($_POST['uptIdentitas'])) {
  $judul    = "SIM SARPRAS";
  $instansi = $_POST['instansi'];
  $deskripsi= $_POST['deskripsi'];
  $alamat   = $_POST['alamat'];
  $telp     = $_POST['telp'];
  $mail     = $_POST['mail'];
  $web      = $_POST['web'];
  $kodepos  = $_POST['kodepos'];
  $hakcipta = $_POST['hakcipta'];

  $upd = mysqli_query($conn, "UPDATE tb_identitas SET
                                                  judul     ='$judul',
                                                  instansi  ='$instansi',
                                                  deskripsi ='$deskripsi',
                                                  alamat    ='$alamat',
                                                  telp      ='$telp',
                                                  mail      ='$mail',
                                                  web       ='$web',
                                                  kodepos   ='$kodepos',
                                                  hakcipta  ='$hakcipta'
                                                WHERE id='1'
                      ");
  if($upd){
    echo("<meta http-equiv='refresh' content='0'>"); //Refresh by HTTP 'meta'
  }
}

?>

        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->


<?php
                      if(isset($_POST['addCategory'])){
                        $nama = $_POST['nama'];
                        $lvl = $_POST['lvl'];

                        $ok = $conn->query("INSERT INTO tb_level VALUES( 
                                                                                '',
                                                                                '$nama',
                                                                                '$lvl'
                                                                              )");
                        if ($ok) {
                          echo("<meta http-equiv='refresh' content='0'>"); //Refresh by HTTP 'meta'
                        }
                      }
                    ?>



<!-- Small modal -->
            <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Tambah Kategori</h4>
                  </div>
                  <div class="modal-body">
                    
                    <form method="post" action="">
                      <div class="form-grup">
                        <div class="form-group">
                          <input type="text" class="form-control" name="nama" placeholder="Tulis nama kategori">
                        </div>
                        <div class="form-group">
                          <select class="form-control" name="lvl">
                              <option value="1"> <i> Admin </i></option>
                              <option value="2"> <i> Ketua/Pmpinan </i></option>
                              <option value="3"> <i> Gudang/Manajer/Ka.Sarpras </i></option>
                              <option value="4"> <i> Pembelian/Umum/Administrasi </i></option>
                          </select>
                        </div>
                        <button type="submit" name="addCategory" class="btn btn-primary btn-flat">Tambahkan</button>
                      </div>
                    </form>
                  </div>
                  
                </div>
              </div>
            </div>

            <!-- Small modal -->
            <div class="modal fade" id="addUpdate" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Ubah Identitas</h4>
                  </div>
                  <div class="modal-body">
                    
                    <form method="post" action="">
                  <tr>
                    <td> Identitas App </td>
                    <td><input class="form-control" type="text" name="judul" value="SIM SARPRAS" disabled="disabled"></td>
                  </tr>
                  <tr>
                    <td>Nama Instansi</td>
                    <td><input class="form-control" type="text" name="instansi" value="<?php echo $q['instansi']; ?>"></td>
                  </tr>
                  <tr>
                    <td>Meta Deskripsi</td>
                    <td>
                      <textarea class="form-control" type="text" name="deskripsi" style="min-width:300px; height:100px;"><?php echo $q['deskripsi']; ?></textarea>
                    </td>
                  </tr>
                  <tr>
                    <td>Alamat</td>
                    <td>
                      <textarea id="textarea" class="form-control" type="address" name="alamat" style="min-width:300px; height:100px;"><?php echo $q['alamat']; ?></textarea>
                    </td>
                  </tr>
                  <tr>
                    <td>Telpone</td>
                    <td><input class="form-control" type="text" name="telp" value="<?php echo $q['telp']; ?>"></td>
                  </tr>
                  <tr>
                    <td>Email</td>
                    <td><input class="form-control" type="mail" name="mail" value="<?php echo $q['mail']; ?>"></td>
                  </tr>
                  <tr>
                    <td>Website</td>
                    <td><input class="form-control" type="text" name="web" value="<?php echo $q['web']; ?>"></td>
                  </tr>
                  <tr>
                    <td>Kode Pos</td>
                    <td><input class="form-control" type="text" name="kodepos" value="<?php echo $q['kodepos']; ?>"></td>
                  </tr>
                  <tr>
                    <td>Copyright</td>
                    <td><input class="form-control" type="text" name="hakcipta" value="<?php echo $q['hakcipta']; ?>"></td>
                  </tr>
                  <br>
                  <div class="modal-footer">
                        <button type="submit" name="uptIdentitas" class="btn btn-success btn-flat pull-right"> <i class="fa fa-save"></i> Simpan perubahan</button>
                      </div>
                    </form>
                  </div>
                  
                </div>
              </div>
            </div>

            <!-- Small modal -->
            <div class="modal fade" id="addLogo" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Upload Logo</h4>
                  </div>
                  <div class="modal-body">
                    
                    <form method="post" action=""  enctype="multipart/form-data">
                      <div class="form-grup">
                        <div class="form-group">
                          <input type="file" name="logo">
                        </div>
                        <button type="submit" name="uptlogo" class="btn btn-primary btn-flat">Update</button>
                      </div>
                    </form>
                  </div>
                  
                </div>
              </div>
            </div>



  </div>
