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