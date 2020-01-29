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
          <h1>Pesanan</h1><hr>

          <form class="form-inline" method="post" action="">
<?php
if(isset($_POST['proses'])){
  $a   = $_POST['proses'];
  $upd = mysqli_query($conn,"UPDATE tb_request SET aksi='2' WHERE id_items='$a' "); 

}
?>
                <div class="table-responsive">
                  <table id="tabel1" class="table table-bordered table-hover" style="font-size: 9pt">
                    <thead>
                      <tr>
                        <th>ID Items</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Oty</th>
                        <th>Satuan</th>
                        <th>Harga</th>
                        <th>Total</th>
                        <th>Prioritas</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
<?php

$req = mysqli_query($conn, "SELECT * FROM tb_request WHERE acc='2' AND aksi='1' OR aksi='2' ");
while($d=mysqli_fetch_assoc($req)){
?>
                      <tr>
                        <td><?php echo $d['id_items']; ?></td>
                        <td><?php echo $d['nm_items']; ?></td>
                        <td><?php echo $d['kategori']; ?></td>
                        <td><?php echo $d['total_acc']; ?></td>
                        <td><?php echo $d['sat_unit']; ?></td>
                        <td><?php echo number_format($d['sat_harga']); ?></td>
                        <td><?php echo number_format($d['total_harga']); ?></td>
                        <td><?php echo $d['status']; ?></td>
                        <td>
                            <?php 
                             
                                  if($d['aksi']==0){
                                    echo "Belum diproses";
                                  }elseif ($d['aksi']==1) {
                                    echo "Sedang diproses";
                                  }else{
                                    echo "<i>Menunggu Konfirmasi</i>";
                                  }
                                ?>

                        </td>
                        <td>
                            <?php if($d['aksi']==0){ echo "Belum diproses";
                                  }elseif ($d['aksi']==2) { ?>
                                  <button type="submit" class="btn btn-xs btn-flat btn-success" disabled="disabled" title="Menunggu Konfirmasi"><i class="fa fa-tags"></i> Complete </button>
                                  <?php }else{ ?>
                                  <button type="submit" class="btn btn-xs btn-flat btn-success" value='<?php echo $d['id_items'] ?>' name="proses" onClick="javascript: return confirm('Yakin sudah Complete?')"><i class="fa fa-tags"></i> Complete </button>
                            <?php  } ?>

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
