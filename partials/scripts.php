<script src="../public/libs/jquery/dist/jquery.min.js"></script>
<script src="../public/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="../public/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- apps -->
<!-- apps -->
<script src="../public/js/app-style-switcher.js"></script>
<script src="../public/js/feather.min.js"></script>
<script src="../public/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<script src="../public/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="../public/js/custom.min.js"></script>
<!--This page JavaScript -->
<script src="../public/c3/d3.min.js"></script>
<script src="../public/libs/c3/c3.min.js"></script>
<script src="../public/libs/chartist/dist/chartist.min.js"></script>
<script src="../public/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
<script src="../public/libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
<script src="../public/libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
<script src="../public/js/pages/dashboards/dashboard1.min.js"></script>

<!--This page plugins -->
<script src="../public/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../public/js/pages/datatable/datatable-basic.init.js"></script>

<script type="text/javascript">
    /* Time API */
    function display_c() {
        var refresh = 1000; // Refresh rate in milli seconds
        mytime = setTimeout('display_ct()', refresh)
    }

    function display_ct() {
        var x = new Date()
        document.getElementById('ct').innerHTML = x;
        display_c();
    }

    /* Ajax */
    function getUnit(val) {
        //get unit name
        $.ajax({
            type: "POST",
            url: "../pages_admin_get_units.php",
            data: 'selected_code_unit=' + val,
            success: function(data) {
                //alert(data);
                $('#unit_name').val(data);
            }
        });

        //get course the unit it belongs to.
        $.ajax({
            type: "POST",
            url: "../pages_admin_get_units.php",
            data: 'unitCourse=' + val,
            success: function(data) {
                //alert(data);
                $('#course_name').val(data);
            }
        });

        //get course id of course which  the unit it belongs to.
        $.ajax({
            type: "POST",
            url: "../pages_admin_get_units.php",
            data: 'courseId=' + val,
            success: function(data) {
                //alert(data);
                $('#course_id').val(data);
            }
        });

        //get id of the selected unit
        $.ajax({
            type: "POST",
            url: "../pages_admin_get_units.php",
            data: 'unitId=' + val,
            success: function(data) {
                //alert(data);
                $('#unit_id').val(data);
            }
        });

        //get instructors name 
        $.ajax({
            type: "POST",
            url: "../pages_admin_get_units.php",
            data: 'instructorName=' + val,
            success: function(data) {
                //alert(data);
                $('#unit_instructor_name').val(data);
            }
        });

        //get instructors id
        $.ajax({
            type: "POST",
            url: "../pages_admin_get_units.php",
            data: 'instructorId=' + val,
            success: function(data) {
                //alert(data);
                $('#unit_instructor_id').val(data);
            }
        });



    }

    /* Print Contents Inside Div */
    function printContent(el) {
        var restorepage = $('body').html();
        var printcontent = $('#' + el).clone();
        $('body').empty().html(printcontent);
        window.print();
        $('body').html(restorepage);
    }
    /* Preloader */
    $(".preloader ").fadeOut();
</script>