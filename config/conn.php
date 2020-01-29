<?php

$server	= 'localhost';
$user	= 'root';
$pwd	= '';
$db		= 'db_sarpras_stimik';

$conn = mysqli_connect($server,$user,$pwd,$db) or die ('Terjadi kesalahan saat menghubungkan ke database').mysqli_error();

?>