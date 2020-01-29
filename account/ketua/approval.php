<?php
if ($_SESSION['level_user'] != 2) {
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
          <h1>Persetujuan</h1><hr>

          <form class="form-inline" method="POST" action="">
<?php
if(isset($_POST['rejek'])){
  $id   = $_POST['id'];


  $update = mysqli_query($conn,"UPDATE tb_request SET acc='1' WHERE id_items='$id' ");
  echo("<meta http-equiv='refresh' content='0'>"); //Refresh by HTTP 'meta'
  if($update){
    echo"
    
    <div class='alert alert-success' style='padding:6px; font-size: 9pt'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
      </button>
      <b>Data BERHASIL Rejeck</b>
    </div>

    "; 
  }else{
    echo"
    <div class='alert alert-warning' style='padding:6px; font-size: 9pt'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
      </button>
      <b>MAAFA TERJADI KESALAHAN </b>
    </div>
    "; 
  }
}

if(isset($_POST['aprov'])){
  $id   = $_POST['id'];
  $qty  = $_POST['qty'];
  $sat  = $_POST['sat_hr'];
  $hit = $qty*$sat;

  $update = mysqli_query($conn,"UPDATE tb_request SET acc='2',total_acc='$qty',total_harga='$hit' WHERE id_items='$id' ");

  //echo("<meta http-equiv='refresh' content='0'>"); //Refresh by HTTP 'meta'
  if($update){
    $sts = 0;
    $add = mysqli_query($conn,"INSERT INTO tb_keranjang VALUE( '','$id','$sts' )");

    echo"
    <div class='alert alert-success' style='padding:6px; font-size: 9pt'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
      </button>
      <b>Data BERHASIL Approval </b>
    </div>

    "; 
  }else{
    echo"
    <div class='alert alert-success' style='padding:6px; font-size: 9pt'>
      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>&times;</span>
      </button>
     <b> MAAF TERJADI KESALAHAN </b>
    </div>
    "; 
  }
}

?>

                <div class="table-responsive">
                  <table id="tabel1" class="table table-bordered table-hover" style="font-size: 9pt">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Pemohon</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>OTY</th>
                        <th>Satuan</th>
                        <th>Harga</th>
                        <th>Total</th>
                        <th>Prioritas</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
<?php 
$req = mysqli_query($conn, "SELECT * FROM tb_request ORDER BY tgl_ajuan ASC");
while($d=mysqli_fetch_assoc($req)){
  $date = $d['tgl_ajuan'];
  $tgl  = date('d M y', strtotime($date));

  $i = 1;

if($d['acc']==3){
?>
                      <tr>
                        <input type="hidden" name="id" value="<?php echo $d['id_items']; ?>">
                        <td><?php echo $i ?></td>
                        <td><?php echo $d['nm_pemohon']; ?> <br><font style='font-size: 8pt'><i class="fa fa-clock-o"></i> <?php echo $tgl ?></font> </td>
                        <td><?php echo $d['nm_items']; ?></td>
                        <td><?php echo $d['kategori']; ?></td>
                        <td>
                          <select class="form-control" type="text" name="qty">
                            <?php 
                              $a = $d['qty'];
                              for ($u=1; $u <= $a; $u++) { 
                            ?>
                                <option value="<?php echo $u ?>" <?php if($a) { echo "selected='selected'";} ?> >
                                  <?php echo $u ?>
                                </option>
                                
                            <?php } ?>
                            
                          </select>
                        </td>
                        <td><?php echo $d['sat_unit']; ?></td>
                        <input type="hidden" name="sat_hr" value="<?php echo $d['sat_harga'] ?>">
                        <td><?php echo number_format($d['sat_harga']); ?></td>
                        <td><?php echo number_format($d['total_harga']); ?></td>
                        <td><?php echo $d['status']; ?></td>
                        <td>
                          <button type="submit" class="btn btn-xs btn-flat btn-danger" name="rejek"><i class="fa fa-close"></i> REJECT</button>

                          <button type="submit" class="btn btn-xs btn-flat btn-success" name="aprov"><i class="fa fa-check"></i> APPROVE</button>
                        </td>
                      </tr>
<?php 
}
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

