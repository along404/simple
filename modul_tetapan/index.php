<?php
include_once '../includes/general.php';

if ((!$_SESSION)) {
    header('location:../login.php');
}
//$current_modul = filter_input(INPUT_GET, 'modul_id');
//$_SESSION['sysm_menu_id'] = $current_modul;
//$modul_id = $_SESSION['sysm_menu_id'];
//$modul_id = sessionModule(filter_input(INPUT_GET, 'modul_id'));

include_once '../includes/mainframe_module.php';
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
                                <h1 class="main-title float-left"><?php echo $_SESSION['sysm_name'] ?>   </h1>                    
                                <ol class="breadcrumb float-right">
                                    <?php // echo 'Tetapan'  ?>
                                    &nbsp;
                                </ol>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->

                    <!-- end row -->

                    <!-- END container-fluid -->
                </div>
                <!-- END content -->
            </div>
            <!-- END content-page -->
        </div>
    </div>
</body>
<?php include_once '../includes/js.php'; ?>

<script>
    $(document).ready(function () {
        $('#logout').click(function () {
            window.location.href = '../logout.php';
        })
    })
</script>

<?php
include_once '../includes/footer.php';
