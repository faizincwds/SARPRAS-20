<?php
include"../config/conn.php";

$day = date('d F Y');


ob_start();

$template = "
<table border='1'>
	<tr>
		<td> PENGAJUAN </td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr></tr>
	<tr></tr>
	<tr>
		<td> STOCK ITEMS </td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr></tr>
	<tr></tr>
	<tr>
		<td> ITEMS RUSAK </td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	<tr></tr>
	<tr></tr>
	<tr>
		<td> ITEMS HILANG </td>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
</table>
			<div style='clear:both;'></div>

";

ob_get_clean();

require_once"../dompdf/autoload.inc.php";

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml($template);

//set papger size 
$dompdf->setPaper('A4', 'landscape');

//Render the html to pdf
$dompdf->render();

$dompdf->stream('PMB-ID-'.$id_d);

?>