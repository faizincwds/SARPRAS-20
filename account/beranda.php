
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">

<!-- Default box -->
      <div class="box" style="border-top:none; box-shadow:0 1px 5px 0px rgba(0,0,0,0.1);">
        <div class="box-body">
          <h1>Dashboard</h1><hr>

              <div class="col-md-3">
               <div class="box box-primary" style="box-shadow:0 1px 5px 0px rgba(0,0,0,0.1);">
                  <div class="box-header with-border">
                    <h3 class="box-title">Filter Data</h3>
                  </div>
                  <!-- /.box-header -->
                  <!-- form start -->
                  <form role="form" action="" method="post">
                    <div class="box-body">
                      <div class="form-group">
                        <label for="exampleInputPassword1">Bulan</label>
                        <select type="text" name="filter" class="form-control">
                          <option value=""> -- Pilih Bulan -- </option>
<?php 

//mendapatkan bulan kemarin
$sekarang = mktime(0,0,0, date('m'),date('d'), date('Y'));
$tgl_wingi = date('Y-m-d', $sekarang);
$tgl_skr = new DateTime($tgl_wingi, new DateTimeZone('Asia/Jakarta'));

for ($i=0; $i < 12 ; $i++) { 
  $no = $tgl_skr->format('d-m-Y');
  $bln = $tgl_skr->format('M Y');
?>
                               <option value="<?php echo $no; ?>" > <?php echo $bln; ?> </option>
<?php 
$tgl_skr->modify('-1 month');
} 
?>
                        </select>
                      </div>
                      <font style="font-size: 9pt">Kosongkan filter bila ingin melihat semua data.</font>
                    </div> 
                    <!-- /.box-body -->
                    <div class="box-footer">
                      <button type="submit" name="src" class="btn btn-primary btn-flat" style="width: 100%;"> <i class="fa fa-search"></i> Lihat data</button>
                    </div>
                  </form>
                </div>
              </div>
<?php
if(isset($_POST['src'])){
$pic = $_POST['filter'];

if ($pic == '') {
 echo("<meta http-equiv='refresh' content='0'>"); //Refresh by HTTP 'meta'
}else{
$src = date('Y-m', strtotime($pic));

//menampilkan semua data namun di tulis 1 kali saja
$qry = mysqli_query($conn," SELECT COUNT(id_items) as ajuan FROM tb_request WHERE tgl_ajuan LIKE '%$src%' ");
$qry1 = mysqli_query($conn," SELECT COUNT(acc) as acc FROM tb_request WHERE acc='2' AND tgl_ajuan LIKE '%$src%' ");
$qry2 = mysqli_query($conn," SELECT COUNT(acc) as acc FROM tb_request WHERE acc='1' AND tgl_ajuan LIKE '%$src%' ");
$qry3 = mysqli_query($conn," SELECT SUM(total_stock) as stock FROM view_stock WHERE stock_bln LIKE '%$src%' ");
$qry4 = mysqli_query($conn," SELECT SUM(jml) as rusak FROM view_stock WHERE sts_kondisi='2' AND tgl_kondisi LIKE '%$src%' ");
$qry5 = mysqli_query($conn," SELECT SUM(jml) as hilang FROM view_stock WHERE sts_kondisi='1' AND tgl_kondisi LIKE '%$src%' ");

$d = mysqli_fetch_assoc($qry);
$d1 = mysqli_fetch_assoc($qry1);
$d2 = mysqli_fetch_assoc($qry2);
$d3 = mysqli_fetch_assoc($qry3);
$d4 = mysqli_fetch_assoc($qry4);
$d5 = mysqli_fetch_assoc($qry5);


$ajuan  = $d['ajuan'];
$acc    = $d1['acc'];
$rejeck   = $d2['acc'];
$stock  = $d3['stock'];
$rusak  = $d4['rusak'];
$hilang = $d5['hilang'];

$cari = date('M Y', strtotime($pic));
?>

            <div class="col-md-9">
               <div class="box box-success" style="box-shadow:0 1px 5px 0px rgba(0,0,0,0.1);">
                  <div class="box-header with-border">
                    <h3 class="box-title">Lihat Data</h3>
                  </div>
                  <div class="box-body">
                      <font style="font-size: 9pt"><?php echo $cari ?></font>
                    <!-- /.box-header -->
                      <table class="table" style="text-align: center;">
                        <thead>
                          <tr>
                            <td><b style="font-size: 16pt;font-family: arial-narrow"> <?php echo $ajuan ?> </b> <br> Pengajuan</td>
                            <td><b style="font-size: 16pt;font-family: arial-narrow"> <?php echo $acc ?> </b> <br> Approve</td>
                            <td><b style="font-size: 16pt;font-family: arial-narrow"> 
                              <?php 
                                 if($rejeck==''){
                                  echo "0";
                                 }else{
                                  echo"$rejeck";
                                 }

                              ?> 
                            </b> <br> Rejeck</td>
                          </tr>
                          <tr>
                            <td><b style="font-size: 16pt;font-family: arial-narrow"> 
                              <?php 
                                 if($stock==''){
                                  echo "0";
                                 }else{
                                  echo"$stock";
                                 }

                              ?>
                             </b> <br> Stock</td>
                            <td><b style="font-size: 16pt;font-family: arial-narrow"> 
                              <?php 
                                 if($rusak==''){
                                  echo "0";
                                 }else{
                                  echo"$rusak";
                                 }

                              ?> 
                             </b> <br> Rusak</td>
                            <td>
                              <b style="font-size: 16pt;font-family: arial-narrow"> 
                              <?php 
                                 if($hilang==''){
                                  echo "0";
                                 }else{
                                  echo"$hilang";
                                 }

                              ?> 
                            </b> <br> Hilang</td>
                          </tr>
                        </thead>
                      </table>

                      <a href="../export/export_exe.php" class="btn btn-success btn-flat" style="width: 100%;"> <i class="fa fa-download"></i> Download All Laporan</a>
                  </div>
                </div>
              </div>

<?php
}

}else{


//menampilkan semua data namun di tulis 1 kali saja
$qry = mysqli_query($conn," SELECT COUNT(id_items) as ajuan FROM tb_request ");
$qry1 = mysqli_query($conn," SELECT COUNT(acc) as acc FROM tb_request WHERE acc='2' ");
$qry2 = mysqli_query($conn," SELECT COUNT(acc) as acc FROM tb_request WHERE acc='1' ");
$qry3 = mysqli_query($conn," SELECT SUM(total_stock) as stock FROM view_stock ");
$qry4 = mysqli_query($conn," SELECT SUM(jml) as rusak FROM view_stock WHERE sts_kondisi='2' ");
$qry5 = mysqli_query($conn," SELECT SUM(jml) as hilang FROM view_stock WHERE sts_kondisi='1' ");
$d = mysqli_fetch_assoc($qry);
$d1 = mysqli_fetch_assoc($qry1);
$d2 = mysqli_fetch_assoc($qry2);
$d3 = mysqli_fetch_assoc($qry3);
$d4 = mysqli_fetch_assoc($qry4);
$d5 = mysqli_fetch_assoc($qry5);


$ajuan  = $d['ajuan'];
$acc    = $d1['acc'];
$rejeck   = $d2['acc'];
$stock  = $d3['stock'];
$rusak  = $d4['rusak'];
$hilang = $d5['hilang'];

?>
              <div class="col-md-9">
               <div class="box box-success" style="box-shadow:0 1px 5px 0px rgba(0,0,0,0.1);">
                  <div class="box-header with-border">
                    <h3 class="box-title">Lihat Data</h3>
                  </div>
                  <div class="box-body">
                      <font style="font-size: 9pt"><?php echo date('M Y');?></font>
                    <!-- /.box-header -->
                      <table class="table" style="text-align: center;">
                        <thead>
                          <tr>
                            <td><b style="font-size: 16pt;font-family: arial-narrow"> <?php echo $ajuan ?> </b> <br> Pengajuan</td>
                            <td><b style="font-size: 16pt;font-family: arial-narrow"> <?php echo $acc ?> </b> <br> Approve</td>
                            <td><b style="font-size: 16pt;font-family: arial-narrow"> 
                              <?php 
                                 if($rejeck==''){
                                  echo "0";
                                 }else{
                                  echo"$rejeck";
                                 }

                              ?>
                            </b> <br> Rejeck</td>
                          </tr>
                          <tr>
                            <td><b style="font-size: 16pt;font-family: arial-narrow"> <?php echo $stock ?> </b> <br> Stock</td>
                            <td><b style="font-size: 16pt;font-family: arial-narrow"> 
                              <?php 
                                 if($rusak==''){
                                  echo "0";
                                 }else{
                                  echo"$rusak";
                                 }

                              ?> 
                            </b> <br> Rusak</td>
                            <td>
                              <b style="font-size: 16pt;font-family: arial-narrow"> 
                              <?php 
                                 if($hilang==''){
                                  echo "0";
                                 }else{
                                  echo"$hilang";
                                 }

                              ?> 
                            </b> <br> Hilang</td>
                          </tr>
                        </thead>
                      </table>

                      <a href="../export/export_exe.php" class="btn btn-success btn-flat" style="width: 100%;"> <i class="fa fa-download"></i> Download All Laporan</a>
                  </div>
                </div>
              </div>
<?php } ?>

        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
