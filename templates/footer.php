</div>
<!-- footer content -->
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Copyright &copy; Kelompok 9 Smakzie 2024</span>
    </div>
  </div>
</footer>
<!-- <footer class="sticky-footer">
  <div class="pull-right" style="color: white;">
    Kelompok 9 Smakzie
  </div>
  <div class="clearfix"></div>
</footer> -->
<!-- /footer content -->
</div>
</div>

<!-- jQuery -->
<script src="assets/vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="assets/vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="assets/vendors/nprogress/nprogress.js"></script>
<!-- Chart.js -->
<script src="assets/vendors/Chart.js/dist/Chart.min.js"></script>
<!-- gauge.js -->
<script src="assets/vendors/gauge.js/dist/gauge.min.js"></script>
<!-- bootstrap-progressbar -->
<script src="assets/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="assets/vendors/iCheck/icheck.min.js"></script>
<!-- Skycons -->
<script src="assets/vendors/skycons/skycons.js"></script>
<!-- Flot -->
<script src="assets/vendors/Flot/jquery.flot.js"></script>
<script src="assets/vendors/Flot/jquery.flot.pie.js"></script>
<script src="assets/vendors/Flot/jquery.flot.time.js"></script>
<script src="assets/vendors/Flot/jquery.flot.stack.js"></script>
<script src="assets/vendors/Flot/jquery.flot.resize.js"></script>
<!-- Flot plugins -->
<script src="assets/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
<script src="assets/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="assets/vendors/flot.curvedlines/curvedLines.js"></script>
<!-- DateJS -->
<script src="assets/vendors/DateJS/build/date.js"></script>
<!-- JQVMap -->
<script src="assets/vendors/jqvmap/dist/jquery.vmap.js"></script>
<script src="assets/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
<script src="assets/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="assets/vendors/moment/min/moment.min.js"></script>
<script src="assets/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- Custom Theme Scripts -->
<script src="assets/build/js/custom.min.js"></script>

<script>
  $(document).ready(function() {
    window.setTimeout(function() {
      $(".alert").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
      });
    }, 4000);
  });
</script>

<script>
  // auto hide notifikasi
  $(document).ready(function() {
    window.setTimeout(function() {
      $(".alert").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
      });
    }, 4000);
  });

  // ambil data id petugas dari tombol ganti password ke modal ganti password
  $('#gantiPassword').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget)
    var id = button.data('id')
    console.log(id)
    var modal = $(this)
    modal.find('.modal-body #id_petugas').val(id)
  })
</script>
</body>

</html>