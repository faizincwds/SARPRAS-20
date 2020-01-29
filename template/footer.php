
  <!-- /.content-wrapper -->
  <footer class="main-footer">
   <div style="text-align: right;"> Copyright &copy; 2019 <a href="https://<?php echo $web ?>"> <?php echo $copy ?> </a>. All rights
    reserved.</div>
  </footer>

</div>

<!-- ./wrapper -->
<script src="../assets/chart.js/Chart.js"></script>
<!-- <script src="../assets/dist/Chart.bundle.js"></script> -->
<script src="../assets/jquery/dist/jquery.min.js"></script>
<script src="../assets/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../assets/raphael/raphael.min.js"></script>
<script src="../assets/morris.js/morris.min.js"></script>
<!-- DataTables -->
<script src="../assets/datatables/js/jquery.dataTables.min.js"></script>
<script src="../assets/datatables/js/dataTables.bootstrap.min.js"></script>
<!-- datepicker -->
<script src="../assets/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<!-- FastClick -->
<script src="../assets/fastclick/lib/fastclick.js"></script>
<script src="../assets/dist/js/adminlte.min.js"></script>
<script src="../assets/dist/js/pages/dashboard.js"></script>
<script src="../assets/dist/js/demo.js"></script>

  <script src="../assets/ckeditor/ckeditor.js"></script>

<script type="text/javascript">
$("#lap").datepicker( {
   format: 'M yyyy',
                viewMode: "months",
                minViewMode: "months",
                autoClose: true
});
</script>

<script type="text/javascript">
  $("#warning-alert").fadeTo(5000, 500).slideUp(500, function(){
    $("#warning-alert").slideUp(500);
});

</script>

<script type="text/javascript">
  $("#angka_unit,#rupiah").keyup(function() {
    var val1 = $('#angka_unit').val(); 
    var val2 = $('#rupiah').val(); 
    var rupiah = Number(val1) * Number(val2);
       $('#jml_ajuan').val(rupiah);
    
  })


   /* Fungsi formatRupiah */
    function rubah(angka){
      var reverse = angka.toString().split('').reverse().join(''),
      ribuan  = reverse.match(/\d{1,3}/gi);
      ribuan  = ribuan.join('.').split('').reverse().join('');
      return ribuan;
   }

</script>

<script type="text/javascript">
  $(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    $("#check-all").click(function(){ // Ketika user men-cek checkbox all
      if($(this).is(":checked")) // Jika checkbox all diceklis
        $(".check-item").prop("checked", true); // ceklis semua checkbox siswa dengan class "check-item"
      else // Jika checkbox all tidak diceklis
        $(".check-item").prop("checked", false); // un-ceklis semua checkbox siswa dengan class "check-item"
    })
  });

    $("#del-admin").click(function(){ // Ketika user mengklik tombol delete
      var confirma = window.confirm("Apakah anda yakin ingin hapus data ini?"); // Buat sebuah alert konfirmasi
      
      if(confirma) // Jika user mengklik tombol "Ok"
      $("#form-delete").submit(); // Submit form
    })


</script>

<script type="text/javascript">
  $(function () {
    $('#tabel1').DataTable()
    $('#tabel2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>

<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>

</body>
</html>
