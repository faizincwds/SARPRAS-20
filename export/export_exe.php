<?php
include"../config/conn.php";
	
	
$tgl = date('d-m-y');

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan-SARPRAS-$tgl.xls");
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sistem PMB");
?>

<table border="1">

<tr> <td colspan="11"><b>LAPORAN PENGAJUAN</b></td> </tr>
				<tr>
				<th>NO</th>
				<th>ID</th>
				<th>TGL PENGAJUAN</th>
				<th>NAMA BARANG</th>
				<th>KATEGORI</th>
				<th>PRIORITAS</th>
				<th>JUMLAH</th>
				<th>JUMLAH APPROVE</th>
				<th>SATUAN HARGA</th>
				<th>TOTAL HARGA</th>
				<th>STATUS</th>
				
				</tr>

				<tbody>
				<?php
				$query = mysqli_query($conn, "SELECT * FROM tb_request ");
				$l = 1;
				while($r=mysqli_fetch_assoc($query)) {                     
											
					?>
				<tr class="odd gradeX">
				<td><?php echo $l ?></td>
				<td><?php echo $r['id_items'] ?></td>
				<td><?php echo $r['tgl_ajuan'] ?></td>
				<td><?php echo $r['nm_items'] ?></td>
				<td><?php echo $r['kategori'] ?></td>
				<td><?php echo $r['status'] ?></td>
				<td><?php echo number_format($r['qty']) ?> <?php echo $r['sat_unit'] ?></td>
				<td><?php echo number_format($r['total_acc']) ?></td>
				<td><?php echo number_format($r['sat_harga']) ?></td>
				<td><?php echo number_format($r['total_harga']) ?></td>
				<td>
					<?php 
                            if($r['acc']==0){
                              echo" <font style='color:blue;'> <i> Sedang ditinjau </i></font>";
                            }elseif($r['acc']==2){
                              echo" <font style='color:green;'> _Diterima </font>";
                            }else{
                              echo" <font style='color:red;'> _Ditolak </font>";
                            }

                          ?> 
				</td>
				
				</tr>
	<?php $l++;  } ?>
</table>
<br>
<br>

<table border="1">

<tr> <td colspan="5"><b>LAPORAN STCOK BARANG</b></td> </tr>
				<tr>
				<th>NO</th>
				<th>ID</th>
				<th>NAMA BARANG</th>
				<th>KATEGORI</th>
				<th>TOTAL STOCK</th>
				
				</tr>

				<tbody>
				<?php
				$sql= mysqli_query($conn,"SELECT * FROM view_stock ");
				$i=1;
				while($d=mysqli_fetch_assoc($sql)) {                     
											
					?>
				<tr class="odd gradeX">
				<td><?php echo $i ?></td>
				<td><?php echo $d['id'] ?></td>
				<td><?php echo $d['nm_items'] ?></td>
				<td><?php echo $d['kategori'] ?></td>
				<td><?php echo number_format($d['total_stock']) ?></td>

				
				</tr>
	<?php $i++;  } ?>
</table>
<br>
<br>

<table border="1">

<tr> <td colspan="8"><b>BARANG RUSAK</b></td> </tr>
				<tr>
				<th>NO</th>
				<th>ID</th>
				<th>TGL RUSAK</th>
				<th>NAMA BARANG</th>
				<th>KATEGORI</th>
				<th>JUMLAH</th>
				<th>KONDISI</th>
				<th>KETERANGAN</th>
				
				</tr>

				<tbody>
				<?php //Perulangan 
				$sql1= mysqli_query($conn,"SELECT * FROM view_stock WHERE sts_kondisi='1' ");
				$a=1;
				while($r=mysqli_fetch_array($sql1)) {                     
											
					?>
				<tr class="odd gradeX">
				<td><?php echo $a ?></td>
				<td><?php echo $r['id_items'] ?></td>
				<td><?php echo $r['tgl_kondisi'] ?></td>
				<td><?php echo $r['nm_items'] ?></td>
				<td><?php echo $r['kategori'] ?></td>
				<td><?php echo number_format($r['jml']) ?></td>
				<td><?php echo $r['kondisi'] ?></td>
				<td><?php echo $r['ket'] ?></td>

				
				</tr>
	<?php $a++;  } ?>
</table>
<br>
<br>

<table border="1">

<tr> <td colspan="8"><b>BARANG HILANG</b></td> </tr>
				<tr>
				<th>NO</th>
				<th>ID</th>
				<th>TGL RUSAK</th>
				<th>NAMA BARANG</th>
				<th>KATEGORI</th>
				<th>JUMLAH</th>
				<th>KONDISI</th>
				<th>KETERANGAN</th>
				
				</tr>

				<tbody>
				<?php //Perulangan 
				$sql1= mysqli_query($conn,"SELECT * FROM view_stock WHERE sts_kondisi='2' ");
				$a=1;
				while($c=mysqli_fetch_array($sql1)) {                     
											
					?>
				<tr class="odd gradeX">
				<td><?php echo $a ?></td>
				<td><?php echo $c['id_items'] ?></td>
				<td><?php echo $c['tgl_kondisi'] ?></td>
				<td><?php echo $c['nm_items'] ?></td>
				<td><?php echo $c['kategori'] ?></td>
				<td><?php echo number_format($c['jml']) ?></td>
				<td><?php echo $c['kondisi'] ?></td>
				<td><?php echo $c['ket'] ?></td>

				
				</tr>
	<?php $a++;  } ?>
</table>