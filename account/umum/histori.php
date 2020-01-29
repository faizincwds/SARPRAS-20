<?php
if ($_SESSION['level_user'] != 4) {
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
          <h3>Riwayat Pembelian</h3><hr>

          <form class="form-inline" method="post" action="">
<?php
if(isset($_POST['proses'])){
  $ids   = $_POST['id_items'];
  $upd = mysqli_query($conn,"UPDATE tb_request SET aksi='2' WHERE id_items='$ids' ");

}
?>
                <div class="table-responsive">
                  <table id="tabel1" class="table table-bordered table-hover" style="font-size: 9pt">
                    <thead>
                      <tr>
                        <th>Pilih</th>
                        <th>ID Items</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total</th>
                        <th>Prioritas</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
<?php




$req = mysqli_query($conn, "SELECT * FROM tb_request WHERE aksi='3' OR aksi='2' ORDER BY tgl_ajuan DESC");
$i  = 1;
while($d=mysqli_fetch_assoc($req)){
  $date = $d['tgl_ajuan'];
  $tgl  = date('d M y', strtotime($date));
  $id_items = $d['id_items'];

?>
                      <tr>
                        <td>
                         <?php echo $i; ?>
                        </td>
                        <td><?php echo $d['id_items']; ?></td>
                        <td><?php echo $d['nm_items']; ?></td>
                        <td><?php echo $d['kategori']; ?></td>
                        <td><?php echo $d['total_acc']; ?> <?php echo $d['sat_unit']; ?></td>
                        <td><?php echo number_format($d['sat_harga']); ?></td>
                        <td><?php echo number_format($d['total_harga']); ?></td>
                        <td><?php echo $d['status']; ?></td>
                        <td>
                            <?php 
                             
                                  if($d['aksi']==2){
                                    echo "<i>Menunggu Konfirmasi</i>";
                                  }else{
                                     echo "Telah Masuk Stock";
                                  }
                                ?>

                        </td>
                      </tr>
<?php
$i++;
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
