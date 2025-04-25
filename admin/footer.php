<footer class="main-footer">
  <strong>Copyright &copy; 2023-2024 <a href="http://paperdeals.in/" target="_blank">paperdeals.in</a>.</strong>
  All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Ready to Leave?</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Select "Logout" below if you are ready to end your current session.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a class="btn btn-danger" href="logout.php">Logout</a>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>

<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- Ekko Lightbox -->
<script src="plugins/ekko-lightbox/ekko-lightbox.min.js"></script>

<script>
  $(function() {
    $("#example1").DataTable({
      "responsive": false,
      "lengthChange": true,
      "autoWidth": true,

      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $("#dataTable").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "order": [
        [0, 'desc']
      ], // Sort by the first column in descending order
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#dataTable_wrapper .col-md-6:eq(0)');
    $("#process").DataTable({
      "responsive": false,
      "lengthChange": true,
      "autoWidth": true,

      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#process_wrapper .col-md-6:eq(0)');
    $("#currentpddeal").DataTable({
      "responsive": false,
      "lengthChange": true,
      "autoWidth": true,
      "order": [
        [1, 'desc']
      ],
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#currentpddeal_wrapper .col-md-6:eq(0)');
    $("#dataTable1").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#dataTable1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

  });
</script>

<script type="text/javascript">
  $(function() {
    $('#datemask').datetimepicker({
      format: 'DD-MM-YYYY'
    });
    $('#dateofjoin').datetimepicker({
      format: 'DD-MM-YYYY'
    });
    $('#datemask1').datetimepicker({
      format: 'DD-MM-YYYY'
    });
    $('#datemask2').datetimepicker({
      format: 'DD-MM-YYYY'
    });
    $('#datemask3').datetimepicker({
      format: 'DD-MM-YYYY'
    });
    $('#datemask4').datetimepicker({
      format: 'DD-MM-YYYY'
    });
    $('#datemask5').datetimepicker({
      format: 'DD-MM-YYYY'
    });
    $('#newsdate').datetimepicker({
      format: 'DD-MM-YYYY'
    });
    $('#dateofsamplehh').datetimepicker({
      format: 'DD-MM-YYYY'
    });
    $('#labreport').datetimepicker({
      format: 'DD-MM-YYYY'
    });
    $('#dateofclearnce').datetimepicker({
      format: 'DD-MM-YYYY'
    });
    $('#transactiondate').datetimepicker({
      format: 'DD-MM-YYYY'
    });
    $('#eddate').datetimepicker({
      format: 'DD-MM-YYYY'
    });
    $('#tdd').datetimepicker({
      format: 'DD-MM-YYYY'
    });
    $('#dat').datetimepicker({
      format: 'DD-MM-YYYY'
    });
    $('#cdate').datetimepicker({
      format: 'DD-MM-YYYY'
    });
    $('#consultant_date').datetimepicker({
      format: 'DD-MM-YYYY'
    });
  });
</script>

<script>
  $(function() {
    //$('.action_div').click(function () {
    $('#dataTable').on('click', '.action_div', function(e) {
      // jQuery.prev()
      $(this).prev('.hide').toggle();
      return false;
    });
  });
</script>

<script>
  $(function() {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });
  })



  // function pushNotify() {
  //       	if (!("Notification" in window)) {
  //       		// checking if the user's browser supports web push Notification
  //       		alert("Web browser does not support desktop notification");
  //       	}
  //       	if (Notification.permission !== "granted")
  //       		Notification.requestPermission();
  //       	else {
  //       		$.ajax({
  //       			url: "push-notify.php",
  //       			type: "POST",
  //       			success: function(data, textStatus, jqXHR) {
  //       				// if PHP call returns data process it and show notification
  //       				// if nothing returns then it means no notification available for now
  //       				if ($.trim(data)) {
  //       					var data = jQuery.parseJSON(data);
  //       					console.log(data);
  //       					notification = createNotification(data.title, data.icon, data.body, data.url);

  //       					// closes the web browser notification automatically after 5 secs
  //       					setTimeout(function() {
  //       						notification.close();
  //       					}, 5000);
  //       				}
  //       			},
  //       			error: function(jqXHR, textStatus, errorThrown) { }
  //       		});
  //       	}
  //       };

  //       function createNotification(title, icon, body, url) {
  //       	var notification = new Notification(title, {
  //       		icon: icon,
  //       		body: body,
  //       	});
  //       	// url that needs to be opened on clicking the notification
  //       	// finally everything boils down to click and visits right
  //       	notification.onclick = function() {
  //       		window.open(url);
  //       	};
  //       	return notification;
  //       }
</script>
</body>

</html>