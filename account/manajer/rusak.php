<?php
if ($_SESSION['level_user'] != 3) {
  echo"<script>alert('Upss!!! Ngga boleh jail ya :) ')</script>";
  echo"<script>location='./'</script>";
}
?>
<?php
                      if(isset($_POST['save'])){

                        $id       = $_POST['id_items'];
                        $jml      = $_POST['jml'];
                        $kondisi  = $_POST['status'];
                        $ket      = $_POST['ket'];
                        $sts_kondisi = 2;
                        $tgl      = date('Y-m-d');

                        $req  = mysqli_query($conn,"SELECT * FROM tb_stock WHERE id_stock='$id' ");
                        $t    = mysqli_fetch_assoc($req);

                        $qty  = $t['total_stock'];
                        $hide = $_POST['jml'];
                        $hilang = $qty - $hide;

                        if($hilang < 0){
                          $pesan= "Jumlah barang rusak yang Anda masukkan melebihi stock yang ada.";
                          $alert= "alert alert-warning";
                        }else{

                        $simpan = mysqli_query($conn, "UPDATE tb_stock SET 
                                                                tgl         ='$tgl',
                                                                jml         ='$jml',
                                                                kondisi     ='$kondisi',
                                                                ket         ='$ket',
                                                                sts_kondisi ='$sts_kondisi'
                                                WHERE id_stock='$id' ");
                        if ($simpan) {
                          echo("<meta http-equiv='refresh' content='0'>"); //Refresh by HTTP 'meta'
                        }
                      }
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
          <h1>Kerusakan Barang</h1><hr>
<?php 
        if(isset($_POST['save'])){ 
          if($hilang < 0){
    ?>

    <div id="warning-alert" class="col-md-5 <?php echo $alert ?>" style="padding:6px; font-size: 9pt">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="alert-heading">Maaf Terjadi Masalah!</h4>
     <?php echo $pesan ?>
    </div>
    <?php } } ?> 
    <div style="clear: both;"></div>
          <form class="form-inline" method="post" action="">
                    <button type="button" class="btn btn-xs btn-primary btn-flat" data-toggle="modal" data-target="#addBroken"><i class="fa fa-plus" ></i> Buat Baru</button>  
                    <button type="submit" name="btl" class="btn btn-xs btn-warning btn-flat" >Batalkan</button><br>
                  <br>
                <div class="table-responsive">
                  <table id="tabel1" class="table table-bordered table-hover"  style="font-size: 9pt">
                    <thead>
                      <tr>
                        <th>Pilih</th>
                        <th>Tgl. Rusak</th>
                        <th>Nama Barang</th>
                        <th>Total</th>
                        <th>Keterangan</th>
                        <th>Penjelasan</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
<?php
if (isset($_POST['opsi'])) {
  $id_opsi   = $_POST['id_opsi'];
  $kondisi   = $_POST['opsi'];
  if($kondisi == "Sudah diperbaiki"){
    $hps  = mysqli_query($conn,"UPDATE tb_stock SET tgl='',jml='0',kondisi='',ket='',sts_kondisi='0' WHERE id_stock='$id_opsi' ");
  }else{
     $hps  = mysqli_query($conn,"UPDATE tb_stock SET kondisi='$kondisi' WHERE id_stock='$id_opsi' ");
  }
}

if (isset($_POST['btl'])) {
  $id   = $_POST['id'];
  $hps  = mysqli_query($conn,"UPDATE tb_stock SET tgl='',jml='0',kondisi='',ket='',sts_kondisi='0' WHERE id_stock='$id' ");
}

$dt = mysqli_query($conn,"SELECT * FROM view_stock WHERE sts_kondisi='2' ");
while ($d=mysqli_fetch_assoc($dt)) {

?>                      
                      <tr>
                        <td><input type="checkbox" name="id" value="<?php echo $d['id'] ?>"></td>
                        <td><?php echo $d['tgl_kondisi'] ?></td>
                        <td><?php echo $d['nm_items'] ?></td>
                        <td><?php echo $d['jml'] ?></td>
                        <td>
                          <?php 
                          if($d['sts_kondisi']==2 ){
                            echo "<b> Rusak </b>";
                          }
                          ?>
                        </td>
                        <td><?php echo $d['ket'] ?></td>
                        <td>
                            <input type="hidden" name="id_opsi" value="<?php echo $d['id']; ?>">
                          <select class="form-control" name="opsi" onchange="this.form.submit()";>>
                            <option value="<?php echo $d['kondisi']; ?>" <?php if($d['kondisi']){ echo "selected='selected'";} ?> > <?php echo $d['kondisi']; ?> </option>
                            <option disabled="disabled"> --- Pilih Status --- </option>
                            <option value="Sudah diperbaiki">Sudah diperbaiki</option>
                            <option value="Dalam perbaikan">Dalam perbaikan</option>
                            <option value="Belum diperbaiki">Belum diperbaiki</option>
                          </select>
                        </td>
                      </tr>
<?php } ?>
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
            <div class="modal fade" id="addBroken" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
              <div class="modal-dialog modal-md">
                <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Tambah Data</h4>
                  </div>
                  <div class="modal-body" style="font-size: 9pt">
                    
                    <form method="post" action="">
                      <div class="form-group">
                        <label>Nama Barang</label>
                        <select class="form-control" name="id_items">
                          <?php 
                            $qry2 = "SELECT * FROM view_stock";
                            $s = mysqli_query($conn, $qry2);
                            while($r = mysqli_fetch_assoc($s)){
                          ?>
                          <option value="<?php echo $r['id']; ?>" > 
                            <?php echo $r['nm_items']; ?> ( <?php echo $r['total_stock'] ?> )
                          </option>
                        <?php } ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Jumlah Barang</label>
                        <input type="text" class="form-control" name="jml" placeholder="Jumlah barang rusak" required>
                      </div>

                      <div class="form-group">
                        <label>Kondisi</label>
                        <select class="form-control" name="status">
                          <option value="Belum diperbaiki">Belum diperbaiki</option>
                          <option value="Dalam perbaikan">Dalam perbaikan</option>
                          <option value="Sudah diperbaiki">Sudah diperbaiki</option>
                        </select>        
                      </div>
                     
                      <div class="form-group">
                        <label>Penjelasa Kerusakan:</label>
                        <textarea type="text" id="editor" name="ket" ></textarea>          
                      </div>

                      <div class="modal-footer">
                        <button type="submit" name="save" class="btn-md btn-flat btn btn-primary">Simpan</button>
                      </div>
                    </form>
                  </div>
                  
                </div>
              </div>
            </div>