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
          <h1>Stock Barang</h1><hr>

          <form class="form-inline" method="post" action="">
            <div class="table-responsive">
                  <table id="tabel1" class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>ID Items</th>
                          <th>Nama Barang</th>
                          <th>Kategori</th>
                          <th>Oty</th>
                          <th>Normal</th>
                          <th>Rusak</th>
                          <th>Hilang</th>
                        </tr>
                      </thead>
                      <tbody>
<?php
$qry = "SELECT * FROM view_stock ORDER BY kategori";
$tb = mysqli_query($conn, $qry);


$i = 1;
while($d=mysqli_fetch_assoc($tb)){

?>
                        <tr>
                          <td><?php echo $i ?></td>
                          <td><?php echo $d['id']; ?></td>
                          <td><?php echo $d['nm_items']; ?></td>
                          <td><?php echo $d['kategori']; ?></td>
                          <td><?php echo $d['total_stock']; ?></td>
                          <td>
                            <?php
                            if ($d['sts_kondisi'] == 1) {
                                $total  = $d['total_stock'];
                                $hilang = $d['jml'];
                                $normal = $total - $hilang;
                                if($normal < 1){
                                  echo "0";
                                }else{
                                  echo "$normal";
                                }
                              }else{
                                echo $d['total_stock'];
                              }
                              ?>
                          </td>
                          <td><?php if($d['sts_kondisi'] == 2){ echo $d['jml']; }else{echo "0";} ?></td>
                          <td><?php if($d['sts_kondisi'] == 1){ echo $d['jml']; }else{echo "0";} ?></td>
                        </tr>
<?php $i++; } ?>


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
