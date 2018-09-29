<?php
include_once 'includes/header.php';
//include_once 'includes/css.php';
include_once 'connection/db_config.php';
include_once 'includes/function.php';
include_once 'config/config.php';

session_start();
if ((!$_SESSION)) {
    header('location:login.php');
}
//unset($_SESSION["sysm_menu_id"]);
//unset($_SESSION["sysm_name"]);
?>
<!--3. custom plugin-->
<script src="includes/component.css"></script>

<!---------------------------------------------------------------------Template Plugin---------------------------------------------------------------------------->


<!-- Switchery css -->
<link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />

<!-- Bootstrap CSS -->
<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

<!-- Font Awesome CSS -->
<link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />

<!-- Custom CSS -->
<link href="assets/css/style.css" rel="stylesheet" type="text/css" />

<!----Datatables---->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
<script src="assets/js/jquery.min.js"></script>
<?php
include_once 'includes/mainframe.php';
?>
<body>
    <div >

        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="breadcrumb-holder">
                                <h1 class="main-title float-left">LAMAN UTAMA</h1>                            
                                <ol class="breadcrumb float-right">
                                    <?php echo breadcrumbs(); ?>
                                </ol>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <?php
                        $db = db_connect();
                        $qDashboard = "select * from sysm_sidebar_master where sysm_parent_id= '00000' order by sysm_order";
                        $resDashboard = $db->query($qDashboard);
                        while ($rowDashboard = $resDashboard->fetch_assoc()) {
                            ?>
                            <div class="col-xs-2 col-md-4 col-lg-2 col-xl-2" onclick="$.post('connection/session_storage.php', {modul_id: <?php echo $rowDashboard['sysm_menu_id'] ?>}); window.location.href = '<?php echo $rowDashboard['sysm_url']; ?>';" style="cursor: pointer">
                                <div class="card-box noradius noborder <?php echo $rowDashboard['sysm_color']; ?>">
                                    <i class="fa <?php echo $rowDashboard['sysm_icon'] ?> left text-white"></i>                          
                                    <h5 class="m-b-20 text-white counter"><?php echo $rowDashboard['sysm_name']; ?></h5>                                
                                </div>
                            </div>
                        <?php } ?>
                    </div>



                    <!-- end row -->

                    <!-- END container-fluid -->
                </div>
                <!-- END content -->
            </div>
            <!-- END content-page -->
        </div>
</body>
<!------------------------------------------------------------------Template Plugin ------------------------------------------------------------------>

<script src="assets/js/modernizr.min.js"></script>
<!--<script src="assets/js/jquery.min.js"></script>-->
<script src="assets/js/moment.min.js"></script>

<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<script src="assets/js/detect.js"></script>
<script src="assets/js/fastclick.js"></script>
<script src="assets/js/jquery.blockUI.js"></script>
<script src="assets/js/jquery.nicescroll.js"></script>

<!-- App js -->
<script src="assets/js/pikeadmin.js"></script>

<!-- BEGIN Java Script for this page -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

<!-- Counter-Up-->
<script src="assets/plugins/waypoints/lib/jquery.waypoints.min.js"></script>
<script src="assets/plugins/counterup/jquery.counterup.min.js"></script>	


<!-----------------------------------------------------3. custom plugin--------------------------------------------------------------------------->
<script src="includes/component.js"></script>

<!--2. Bootstrap Plugin-->
<script src="assets/js/bootstrap-datepicker.min.js"></script>
<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/bootbox.min.js"></script>
<script type="text/javascript" src="assets/js/datatables.js"></script>
<script type="text/javascript" src="assets/js/datatables.min.js"></script>
<script src="assets/plugins/select/js/bootstrap-select.js"></script>

<script>
                                $(document).ready(function () {
                                    $('#logout').click(function () {
                                        window.location.href = 'logout.php';
                                    });
                                    $.post('includes/function.php', {modul_id: <?php echo $rowDashboard['sysm_menu_id'] ?>})
                                })
</script>

<?php
include_once 'includes/footer.php';
