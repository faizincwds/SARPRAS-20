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
          <h1>Barang Baru</h1><hr>

          <form class="form-inline" method="post" action="">
            <button type="submit" class="btn btn-xs btn-flat btn-success" name="proses"><i class="fa fa-database"></i> Masukkan Stock</button> <br><br>

                <div class="table-responsive">
                  <table id="tabel1" class="table table-bordered table-hover" style="font-size: 9pt">
                    <thead>
                      <tr>
                        <th>Pilih</th>
                        <th>ID Items</th>
                        <th>Tgl. Pengajuan</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>QTY</th>
                        <th>Satuan</th>
                        <th>Harga</th>
                        <th>Total</th>
                        <th>Prioritas</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                  <tbody>
<?php
if(isset($_POST['proses'])){

  $jmldata  = count($_POST['id_items']);
  $check    = $_POST['id_items'];

  for($cek=0; $cek < $jmldata; $cek++){
    $cek_data = mysqli_query($conn,"SELECT * FROM tb_request WHERE id_items='$check[$cek]' ");
    $r = mysqli_fetch_assoc($cek_data);
    $total = $r['total_acc'];

    $oke = mysqli_query($conn, "INSERT INTO tb_stock (id_stock,total_stock) VALUES(
                                                       '$check[$cek]',
                                                       '$total' 
                                                   )");
    if ($oke){
      $info = mysqli_query($conn, "UPDATE tb_request SET aksi='3' WHERE id_items='$check[$cek]' ");
    }else{
      echo "Maaf! Terjadi kesalahan 404";
    }
  }
}
?>

<?php 
$stk = mysqli_query($conn, "SELECT id_stock FROM tb_stock ");
$o = mysqli_fetch_assoc($stk);

$req = mysqli_query($conn, "SELECT * FROM tb_request WHERE acc='2' AND aksi != '3' AND aksi !='0' ORDER BY aksi DESC");
while($d=mysqli_fetch_assoc($req)){
  $date = $d['tgl_ajuan'];
  $tgl  = date('d M y', strtotime($date));
  $id_items = $d['id_items'];

?>
                      <tr>
                        <td>
                        <?php if($d['aksi']=='3' OR $d['aksi']=='0'){ ?>
                          
                          <input type='checkbox' value='<?php echo $id_items ?>' disabled='disabled' Title='Telah masuk Stock Barang'>

                        <?php }elseif($d['aksi']=='1'){ ?>
                          <input type='checkbox' value='<?php echo $id_items ?>' disabled='disabled' Title='<?php if($d['aksi']==0){ echo "Belum diproses"; }elseif ($d['aksi']==1) {echo "Sedang diproses"; } ?>' >
                        <?php }else{ ?>
                          <input class='check-item' type='checkbox' name='id_items[]' value='<?php echo $id_items ?>' >
                        <?php } ?>
                        </td>
                        <td><?php echo $d['id_items']; ?></td>
                        <td><i class="fa fa-clock-o"></i> <?php echo $tgl ?> </td>
                        <td><?php echo $d['nm_items']; ?></td>
                        <td><?php echo $d['kategori']; ?></td>
                        <td><?php echo $d['total_acc']; ?></td>
                        <td><?php echo $d['sat_unit']; ?></td>
                        <td><?php echo number_format($d['sat_harga']); ?></td>
                        <td><?php echo number_format($d['total_harga']); ?></td>
                        <td><?php echo $d['status']; ?></td>
                        <td>
                            <?php 
                            
                                  if ($d['aksi']==1) {
                                    echo "Sedang diproses";
                                  }elseif ($d['aksi']==2){
                                    echo " <i class='fa fa-check-circle'></i> Sukses ";
                                  }else{
                                    echo "Telah Masuk Stock";
                                  }
                                ?>

                        </td>
                      </tr>
<?php

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