<!-- Jquery -->
<script src="../public/libs/jquery/dist/jquery.min.js "></script>
<!-- Popper Js -->
<script src="../public/libs/popper.js/dist/umd/popper.min.js "></script>
<!-- Boostrap -->
<script src="../public/libs/bootstrap/dist/js/bootstrap.min.js "></script>
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