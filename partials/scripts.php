<!-- jQuery -->
<script src="../public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!--  App Js -->
<script src="../public/js/adminlte.min.js"></script>
<!-- Swal Scripts -->
<script src="../public/js/swal.js"></script>
<!-- Init Swal To Inject Errors -->
<?php if (isset($success)) { ?>
  <!--This code for injecting an alert-->
  <script>
    setTimeout(function() {
        swal("Success", "<?php echo $success; ?>", "success");
      },
      100);
  </script>

<?php } ?>

<?php if (isset($err)) { ?>
  <!--This code for injecting an alert-->
  <script>
    setTimeout(function() {
        swal("Failed", "<?php echo $err; ?>", "error");
      },
      100);
  </script>

<?php } ?>

<!-- overlayScrollbars -->
<script src="../public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- Dashboard -->
<script src="../public/js/pages/dashboard2.js"></script>
<!-- DataTables -->
<script src="../public/plugins/datatables/jquery.dataTables.js"></script>
<script src="../public/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- Advanced Reporting Data Tables  -->
<!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
<script src="../public/plugins/datatable/button-ext/dataTables.buttons.min.js"></script>
<script src="../public/plugins/datatable/button-ext/jszip.min.js"></script>
<script src="../public/plugins/datatable/button-ext/buttons.html5.min.js"></script>
<script src="../public/plugins/datatable/button-ext/buttons.print.min.js"></script>
<script>
  $('#reports').DataTable({
    dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
    buttons: {
      buttons: [{
          extend: 'copy',
          className: 'btn'
        },
        {
          extend: 'csv',
          className: 'btn'
        },
        {
          extend: 'excel',
          className: 'btn'
        },
        {
          extend: 'print',
          className: 'btn'
        }
      ]
    },
    "oLanguage": {
      "oPaginate": {
        "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
        "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
      },
      "sInfo": "Showing page _PAGE_ of _PAGES_",
      "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
      "sSearchPlaceholder": "Search...",
      "sLengthMenu": "Results :  _MENU_",
    },
    "stripeClasses": [],
    "lengthMenu": [7, 10, 20, 50],
    "pageLength": 7
  });
</script>
<!-- Init Data Tables -->
<script>
  $(function() {
    $("#dash-1").DataTable();
    $("#dash-2").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
<!-- Init CK -->
<script>
  CKEDITOR.replace('editor');
  CKEDITOR.replace('editor1');
  CKEDITOR.replace('editor2');
</script>

<!-- File Uploads  -->
<script src="../public/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
  $(document).ready(function() {
    bsCustomFileInput.init();
  });
</script>
<!-- Select 2  -->
<script src="../public/plugins/select2/js/select2.full.min.js"></script>
<script>
  $('.select2bs4').select2({
    theme: 'bootstrap4'
  })
</script>
<!-- Ajaxes -->
<script>
  /* Course Details */
  function GetCourseDetails(val) {
    $.ajax({

      type: "POST",
      url: "../partials/ajax.php",
      data: 'Course_Code=' + val,
      success: function(data) {
        //alert(data);
        $('#Course_Id').val(data);
      }
    });

    $.ajax({
      type: "POST",
      url: "../partials/ajax.php",
      data: 'Course_Id=' + val,
      success: function(data) {
        //alert(data);
        $('#Course_Name').val(data);
      }
    });
  }

  /* Unit Details */
  function GetUnitDetails(val) {
    $.ajax({

      type: "POST",
      url: "../partials/ajax.php",
      data: 'Unit_Code=' + val,
      success: function(data) {
        //alert(data);
        $('#Unit_Name').val(data);
      }
    });

    $.ajax({
      type: "POST",
      url: "../partials/ajax.php",
      data: 'Unit_Name=' + val,
      success: function(data) {
        //alert(data);
        $('#Unit_Id').val(data);
      }
    });

    $.ajax({
      type: "POST",
      url: "../partials/ajax.php",
      data: 'Unit_Id=' + val,
      success: function(data) {
        //alert(data);
        $('#Course_Id').val(data);
      }
    });

    $.ajax({
      type: "POST",
      url: "../partials/ajax.php",
      data: 'Course_Id=' + val,
      success: function(data) {
        //alert(data);
        $('#Course_Name').val(data);
      }
    });
  }

  /* Instructor Details */
  function GetInstructorDetails(val) {
    $.ajax({

      type: "POST",
      url: "../partials/ajax.php",
      data: 'Ins_Number=' + val,
      success: function(data) {
        //alert(data);
        $('#Ins_Name').val(data);
      }
    });

    $.ajax({
      type: "POST",
      url: "../partials/ajax.php",
      data: 'Ins_Name=' + val,
      success: function(data) {
        //alert(data);
        $('#Ins_Id').val(data);
      }
    });
  }

  /* Allocation Details */
  function GetAllocatedUnitDetails(val) {
    $.ajax({

      type: "POST",
      url: "../partials/ajax.php",
      data: 'Allocated_Unit_Code=' + val,
      success: function(data) {
        //alert(data);
        $('#Allocated_Unit_Name').val(data);
      }
    });

    $.ajax({
      type: "POST",
      url: "../partials/ajax.php",
      data: 'Allocated_Unit_Name=' + val,
      success: function(data) {
        //alert(data);
        $('#Allocated_Ins_Name').val(data);
      }
    });

    $.ajax({
      type: "POST",
      url: "../partials/ajax.php",
      data: 'Allocated_Ins_Name=' + val,
      success: function(data) {
        //alert(data);
        $('#Allocated_Course_ID').val(data);
      }
    });

    $.ajax({
      type: "POST",
      url: "../partials/ajax.php",
      data: 'Allocated_Course_ID=' + val,
      success: function(data) {
        //alert(data);
        $('#Allocated_Unit_ID').val(data);
      }
    });

    $.ajax({
      type: "POST",
      url: "../partials/ajax.php",
      data: 'Allocated_Unit_ID=' + val,
      success: function(data) {
        //alert(data);
        $('#Allocated_Ins_ID').val(data);
      }
    });

    $.ajax({
      type: "POST",
      url: "../partials/ajax.php",
      data: 'Allocated_Ins_ID=' + val,
      success: function(data) {
        //alert(data);
        $('#Allocated_Course_Name').val(data);
      }
    });


  }

  /* Student  Details */
  function GetStudentDetails(val) {
    $.ajax({

      type: "POST",
      url: "../partials/ajax.php",
      data: 'Std_Admn=' + val,
      success: function(data) {
        //alert(data);
        $('#Std_Name').val(data);
      }
    });

    $.ajax({
      type: "POST",
      url: "../partials/ajax.php",
      data: 'Std_Name=' + val,
      success: function(data) {
        //alert(data);
        $('#Std_Id').val(data);
      }
    });
  }
</script>
<!-- Print Contents Inside A Div -->
<script>
  function printContent(el) {
    var restorepage = $('body').html();
    var printcontent = $('#' + el).clone();
    $('body').empty().html(printcontent);
    window.print();
    $('body').html(restorepage);
  }
</script>