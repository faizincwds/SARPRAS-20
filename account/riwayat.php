

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">

<!-- Default box -->
      <div class="box" style="border-top:none; box-shadow:0 1px 5px 0px rgba(0,0,0,0.1);">
        <div class="box-header with-border">
        <div class="box-body">
          <h1> Riwayat</h1><hr>

          <form class="form-inline" id="form-delete" method="post" action="">
                <div class="table-responsive">
                  <table id="tabel1" class="table table-bordered table-hover" style="font-size: 9pt">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Tgl.Ajuan</th>
                        <th>Pemohon</th>
                        <th>Items</th>
                        <th>OTY</th>
                        <th>Harga</th>
                        <th>Total</th>
                        <th>Prioritas</th>
                        <th>Approve</th>
                        <th>Tgl.Approve</th>
                        <th>Status</th>
                        <th>Pembelian</th>
                      </tr>
                    </thead>
                    <tbody>
                      
<?php 


        $req = mysqli_query($conn, "SELECT * FROM tb_request WHERE acc='1' OR acc='2' ORDER BY tgl_ajuan DESC");

        $i = 1;
        while($d=mysqli_fetch_assoc($req)){
          $date = $d['tgl_ajuan'];
          $date_acc = $d['tgl_acc'];
          $tgl  = date('d M y', strtotime($date));
          $tgl_acc  = date('d M y', strtotime($date_acc));
          $id_items = $d['id_items'];
        ?>
                      <tr>
                        <td>
                         <?php echo $i; ?>
                        </td>
                        <td><?php echo $tgl ?></td>
                        <td><?php echo $d['nm_pemohon']; ?></td>
                        <td><?php echo $d['nm_items']; ?></td>
                        <td><?php echo number_format($d['qty']); ?> <?php echo $d['sat_unit']; ?></td>
                       
                        <td><?php echo number_format($d['sat_harga']); ?></td>
                        <td><?php echo number_format($d['total_harga']); ?></td>
                        <td><i><?php echo $d['status']; ?></i></td>
                        <td><?php echo number_format($d['total_acc']); ?> <?php echo $d['sat_unit']; ?></td>
                        <td><?php echo $tgl_acc ?></td>
                        <td>
                          <?php 
                          $acc = $d['total_acc'];
                            if($d['acc']==0){
                              echo" <i> Sedang ditinjau </i>";
                            }elseif($d['acc']==2){
                              echo"
                              <b style='color:green;'> Aprove</b>
                              ";
                            }else{
                              echo" <b style='color:red;'><i> _Rejek </i></b> ";
                            }

                          ?>                            
                          </td>
                          <td>
                            <?php 
                            
                                  if($d['acc']==1){
                                    echo "<I>REJECK</I>";
                                  }elseif ($d['aksi']==0) {
                                    echo "Sedang diproses";
                                  }elseif ($d['aksi']==1) {
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
