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
      <div class="box" style="border-top:none; box-shadow:0 1px 5px 0px rgba(0,0,0,0.1);">
        <div class="box-header with-border">
        <div class="box-body">
        	<div class="container-fluid">
          		<h1>Kelola Pengguna</h1>
          		<hr>
<?php 

if (isset($_POST['del'])) {
	$id		=	$_POST['codeId'];
	$hps 	= mysqli_query($conn,"DELETE FROM tb_user WHERE id IN(".implode(",", $id).") ");//muti delete
}

if (isset($_POST['update'])) {
	$id			= $_POST['id'];
	$level		= $_POST['update'];
	$update 	= mysqli_query($conn,"UPDATE tb_user SET level='$level' WHERE id='$id' ");

	if ($update) {
		$_SESSION['level_user'] = $level;
		echo("<meta http-equiv='refresh' content='0'>"); //Refresh by HTTP 'meta'
	}else{
		echo "gagal";
	}
}
?>
          		<form method="POST" action="">

          		<button type="button" class="btn btn-xs btn-primary btn-flat" data-toggle="modal" data-target="#addUser">Tambah</button> 
          		
          		<button type="submit" name="del" class="btn btn-xs btn-danger btn-flat" onclick="return confirm('Apakah anda yakin ingin menghapus pengguna ini? Semua data yang terkait akan terhapus secara permanent');">Hapus</button> 
          		<button type="submit" class="btn btn-xs btn-warning btn-flat" name="pwd">Send Password</button> <br><br>

          		<div class="table-responsive">
            		<table id="tabel1" class="table table-hover table-bordered">
            			<thead>
				            <tr>
				              <th>Pilih</th>
				              <th>Nama Lengkap</th>
				              <th>Username</th>
				              <th>Email</th>
				              <th>Level Users</th>
				              <th>History</th>
				            </tr>
				        </thead>
				        <tbody>
<?php

$qry = mysqli_query($conn,"SELECT * FROM tb_user ORDER BY id DESC");
while($r = mysqli_fetch_assoc($qry)){
$lvl = $r['level'];

$daftar = $r['tgl_daftar'];
$date 		= date('d M Y', strtotime($daftar));

$login 		= $r['log_masuk'];
$logout 	= $r['log_keluar'];
$log_login 	= date('d.M.y', strtotime($login));
$log_login1 = date('H.i', strtotime($login));

$log_logout = date('d M y', strtotime($logout));
$log_logout1 = date('H.i', strtotime($logout));

//untuk hapus data

?>				        	
				            <tr>
				            	<td>
			            		<?php if($r['username'] == $_SESSION['login_user']){ ?>
			            			<input type="checkbox" name="codeId[]" disabled="disabled" value="<?php echo $r['id']; ?>"> 
			            		<?php }else{ ?>
			            			<input type="checkbox" name="codeId[]" value="<?php echo $r['id']; ?>"> 
			            		<?php } ?>
				            	 </form>
				            	</td>
				            	
				            	<td><?php echo $r['nama']; ?></td>
				            	<td><?php echo $r['username']; ?></td>
				            	<td><?php echo $r['email']; ?></td>
				            	<td>
				            		<form method="post" action="">
				            		<input type="hidden" name="id" value="<?php echo $r['id']; ?>">
				            		<select class="form-control" name="update" onchange="this.form.submit()";>
				            			
				            		<?php 
				           	 			$tb = mysqli_query($conn,"SELECT * FROM tb_level");
										
										while($ro = mysqli_fetch_assoc($tb)){
											$lev 		= $ro['level'];
											$kategori 	= $ro['nm_level'];
				            		?>
				            			<option value="<?php echo $lev ?>" 
				            				<?php if($lvl == $lev) { echo "selected='selected'";} ?> > 
				            				<?php echo $kategori ?> 
				            			</option>
				            		<?php } ?>
				            		</select>
				            		</form>
				            	</td>

				            	<td>
				            		<button type="button" class="btn btn-xs btn-flat btn-info" data-toggle="modal" data-target="#showLog-<?php echo $r['id']; ?>">History Activity</button>
				            		
				            	</td>
				            	
				            </tr>
				           

				            <!-- Small modal -->
						<div class="modal fade" id="showLog-<?php echo $r['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
						  <div class="modal-dialog modal-md">
						    <div class="modal-content">
						    	<div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title">History Activity</h4>
							    </div>
						      <div class="modal-body">
						      	 <ul class="timeline">
				                    <!-- timeline time label -->
				                    <li class="time-label">
				                        <span class="bg-green">
				                            Terdaftar : <?php echo $date ?>
				                        </span>
				                    </li>
				                    <!-- /.timeline-label -->

				                    <li>
				                        <!-- timeline icon -->
				                        <i class="fa fa-user bg-blue"></i>
				                        <div class="timeline-item">
				                            <h3 class="timeline-header"><a href="#"> <?php echo $r['nama']; ?></a> </h3>
				                        </div>
				                        <div class="timeline-item">
				                            <h3 class="timeline-header">

				                            	<span style="font-size: 10pt"> 
				                            		Terakhir login :  <?php echo $log_login ?> 
				                            		<i class="fa fa-clock-o pull-right" style="font-size: 8pt">  <?php echo $log_login1 ?> </i>
				                            	</span> <br>
				                            	<span style="font-size: 10pt"> 
				                            		Terakhir Logout :  <?php echo $log_logout ?> 
				                            		<i class="fa fa-clock-o pull-right" style="font-size: 8pt">  <?php echo $log_logout1 ?> </i>
				                            	</span>
				                            </h3>
				                        </div>
				                    </li>
				                    <li> <i  class="fa fa-clock-o bg-gray"></i> </li>
				                </ul>
						      </div>
						      
						    </div>
						  </div>
						</div>
<?php } ?>
			        	</tbody>
			        </table>
				</div>
			        <!-- Small modal -->
						<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
						  <div class="modal-dialog modal-md">
						    <div class="modal-content">
						    	<div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title">Tambah Pengguna</h4>
							    </div>
						      <div class="modal-body">
						      	<?php
						      		if(isset($_POST['save'])){
						      			$nama = $_POST['nama'];
						      			$username = $_POST['username'];
						      			$password = md5($_POST['password']);
						      			$email = $_POST['email'];
						      			$level = $_POST['level'];
						      			$ver = "0";

						      			$tgl = date('Y-m-d');

						      			$simpan = $conn->query("INSERT INTO tb_user VALUES( '',
						      																'',
						      																'$nama',
						      																'$username',
						      																'$password',
						      																'$email',
						      																'$level',
						      																'$tgl',
						      																'',
						      																'',
						      																'$ver'
						      															)");
						      			if ($simpan) {
						      				echo("<meta http-equiv='refresh' content='0'>"); //Refresh by HTTP 'meta'
						      			}
						      		}
						      	?>
						      	<form method="post" action="">
						      		<div class="form-group">
									    <input type="nama" class="form-control" name="nama" placeholder="Nama Lengkap" required>
									</div>
									<div class="form-group">
									    <input type="username" class="form-control" name="username" placeholder="Username" required>
									</div>
									<div class="form-group">
									    <input type="password" class="form-control" name="password" placeholder="Username" required>
									</div>
									<div class="form-group">
									    <input type="email" class="form-control" name="email" placeholder="Email" required="@">
									</div>
									<div class="form-group">
									   <select class="form-control" name="level">
			                              <?php 
			                                $qry = mysqli_query($conn,"SELECT * FROM tb_level ORDER BY level");
			                                while($r = mysqli_fetch_assoc($qry)){
			                              ?>
			                              <option value="<?php echo $r['level'] ?>"  > 
			                                <?php echo $r['nm_level']; } ?> 
			                              </option>
			                            </select>
									</div>
									<div class="modal-footer">
						        <button type="submit" name="save" class="btn-md btn-flat btn btn-primary">Simpan</button>
						      </div>
						      	</form>
						      </div>
						      
						    </div>
						  </div>
						</div>
					 
        </div>
        </div>
      </div>
	</div>
    </section>

  </div>