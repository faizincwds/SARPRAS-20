<?php
if ($_SESSION['level_user'] != 3) {
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
          <h1>Pengajuan Inventaris</h1><hr>

          <form class="form-inline" method="POST" action="">
                    <button type="button" class="btn btn-xs btn-primary btn-flat" data-toggle="modal" data-target="#addAjuan"><i class="fa fa-plus" ></i> Buat Draft</button><br>
                  <br>
<?php
//hapus pengajuan
if (isset($_POST['del'])) {
  $id   = $_POST['codeID'];
  $hps  = mysqli_query($conn,"DELETE FROM tb_request WHERE id_items='$id' ");//muti delete
      
  if ($hps) {
    $alert  = "alert alert-success alert-flat";
    $pesan  = " Draft pengajuan berhasil di <b>HAPUS</b> ";
    echo("<meta http-equiv='refresh' content='2'>"); //Refresh by HTTP 'meta'  
  }else{
      $alert  = "alert alert-warning alert-flat";
      $pesan  = " <b>Maaf!</b> Terjadi Kesalahan. ";
  }

}
//ajukan
if (isset($_POST['send'])) {
  $id   = $_POST['codeID'];
  $send  = mysqli_query($conn,"UPDATE tb_request SET acc='3' WHERE id_items='$id' ");//muti delete
  
  if ($send) {
    $alert  = "alert alert-success alert-flat";
    $pesan  = " Draft pengajuan berhasil <b>TERKIRIM</b> ";
    echo("<meta http-equiv='refresh' content='4'>"); //Refresh by HTTP 'meta'  
  }else{
      $alert  = "alert alert-warning alert-flat";
      $pesan  = " <b>Maaf!</b> Terjadi Kesalahan. ";
  }

}
?>
              <?php 
                if(isset($_POST['del'])){ 
              ?>
                  <div class="col-md-4 <?php echo $alert ?>" style="padding:6px; font-size: 9pt">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                   <?php echo $pesan ?>
                  </div>
                  <?php } ?>
                  <div style="clear: both;"></div>
                <div class="table-responsive">
                  <table id="tabel1" class="table table-bordered table-hover" style="font-size: 9pt">
                    <thead>
                      <tr>
                        <th>ID Item</th>
                        <th>Pemohon</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>OTY</th>
                        <th>Satuan</th>
                        <th>Harga</th>
                        <th>Total</th>
                        <th>Prioritas</th>
                        <th>Tgl. Pengajuan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      
<?php

        $req = mysqli_query($conn, "SELECT * FROM tb_request WHERE acc != '1'  ORDER BY tgl_ajuan ASC");
        while($d=mysqli_fetch_assoc($req)){
          $date = $d['tgl_ajuan'];
          $tgl  = date('d M y', strtotime($date));
          $id_items = $d['id_items'];
      if(!$d['aksi']=='3'){
        ?>
                      <tr>
                        <input type="hidden" name="codeID" value="<?php echo $d['id_items']; ?>">
                        <td><?php echo $d['id_items']; ?></td>
                        <td><?php echo $d['nm_pemohon']; ?></td>
                        <td><?php echo $d['nm_items']; ?></td>
                        <td><?php echo $d['kategori']; ?></td>
                        <td><?php echo number_format($d['qty']); ?></td>
                        <td><?php echo $d['sat_unit']; ?></td>
                        <td><?php echo number_format($d['sat_harga']); ?></td>
                        <td><?php echo number_format($d['total_harga']); ?></td>
                        <td><i><?php echo $d['status']; ?></i></td>
                        <td><?php echo $tgl ?></td>
                        <td>
                          <?php 
                            if($d['acc']==0 AND $d['aksi']==0){
                              echo"<b> DRAFT </b>";
                            }elseif($d['acc']==2 AND $d['aksi']==0){
                              echo "Disetujui: <b>$d[total_acc] items </b> <br> <i> (Belum diproses) </i>";
                            }elseif($d['acc']==3 AND $d['aksi']==0){
                              echo"Sedang ditinjau";
                            }else{
                              echo "Maaf! Terjadi masalah. Silahkan hubungi Developher ";
                            }

                          ?>                            
                          </td>
                          <td>
                            <?php 
                            if($d['acc']==0 AND $d['aksi']==0){
                              echo" <button class='btn btn-xs btn-flat btn-danger' type='submit' name='del'> <i class='fa fa-trash' title='Hapus'></i> </button> ";
                              echo" <button class='btn btn-xs btn-flat btn-success' type='submit' name='send'> <i class='fa fa-send' title='Ajukan'></i> </button> ";
                            }elseif($d['acc']==2 AND $d['aksi']==0 OR $d['acc']==3 AND $d['aksi']==0){
                             echo" <button class='btn btn-xs btn-flat btn-danger' disabled='disabled'> <i class='fa fa-trash' title='Hapus'></i> </button> ";
                              echo" <button class='btn btn-xs btn-flat btn-success' disabled='disabled'> <i class='fa fa-send' title='Ajukan'></i> </button> ";
                            }else{
                              echo "Maaf! Terjadi masalah. Silahkan hubungi Developher ";
                            }

                          ?> 
                          </td>
                      </tr>
      
                     
<?php 
}
} 

?>
                     
                    </tbody>
                </table>
              </div>
          </form>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>


<!-- Small modal -->
            <div class="modal fade" id="addAjuan" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Buat Pengajuan</h4>
                  </div>
                  <div class="modal-body">
                    <form method="post" action="">
                      <div class="form-grup">
                        <div class="form-group">
                          <label>Nama Barang</label>
                          <input type="text" class="form-control" name="nm_barang" placeholder="Nama barang">
                        </div>
                        <div class="form-group">
                          <label>Kategori Barang</label>
                          <select class="form-control" name="kategori">
                              <option value="Elektronik"> Elektronik </option>
                              <option value="Furniture"> Furniture </option>
                              <option value="Komputer"> Komputer </option>
                              <option value="Software"> Software </option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Jumlah</label>
                          <input type="number" class="form-control uang" name="qty" id="angka_unit">
                        </div>
                        <div class="form-group">
                          <label>Satuan</label>
                          <select class="form-control" name="sat_unit">
                              <option value="Unit"> Unit </option>
                              <option value="Box"> Box </option>
                              <option value="Pack"> Pack </option>
                              <option value="Kg"> Kg </option>
                              <option value="Pcs"> Pcs </option>
                              <option value="Meter"> Meter </option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Satuan Harga</label>
                          <input type="text" class="form-control" name="sat_harga" id="rupiah">
                        </div>
                        <div class="form-group">
                          <label>Total Harga</label>
                          <input type="number" class="form-control" name="total_harga" id="jml_ajuan" readonly>
                        </div>
                        <div class="form-group">
                          <label>Prioritas</label>
                          <select class="form-control" name="prioritas">
                              <option value="NORMAL"> <i> NORMAL </i></option>
                              <option value="MENDESAK"> <i> MENDESAK </i></option>
                          </select>
                        </div>
                        <div class="modal-footer">
                        <button type="submit" name="ajukan" class="btn btn-primary btn-flat btn-md pull-right">Simpan</button>
                      </div>
                      </div>
                    </form>
                  </div>
                  
                </div>
              </div>
            </div>


<?php


//Tambah pengajuan
if(isset($_POST['ajukan'])){
  $tgl_ajuan    = date('Y-m-d');
  $pemohon      = $_SESSION['nama_user'];
  $nm_barang    = $_POST['nm_barang'];
  $kategori     = $_POST['kategori'];
  $qty          = $_POST['qty'];
  $sat_unit     = $_POST['sat_unit'];
  $sat_harga    = $_POST['sat_harga'];
  $total_harga  = $_POST['total_harga'];
  $prioritas    = $_POST['prioritas'];
  $n            = 0;
  
  $rand = mt_rand(1,999);
  $big = strtoupper($kategori);
  $cut = substr($big,0,2);
  $idCode = $cut.$rand;


  $save = mysqli_query($conn,"INSERT INTO tb_request VALUE(
                                                      '$idCode',
                                                      '$tgl_ajuan',
                                                      '$pemohon',
                                                      '$nm_barang',
                                                      '$kategori',
                                                      '$qty',
                                                      '$sat_unit',
                                                      '$sat_harga',
                                                      '$total_harga',
                                                      '',
                                                      '$prioritas',
                                                      '',
                                                      '$n',
                                                      '$n'

  )");

  if($save){
    echo"PENGAJUAN BERHASIL DIKIRIM";
    echo("<meta http-equiv='refresh' content='0'>"); //Refresh by HTTP 'meta'
  }else{
    echo "MAAF TERJADI KESALAHAN";
  }

}

?>