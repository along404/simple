<?php
include_once '../includes/general.php';
if ((!$_SESSION)) {
    header('location:../login.php');
}
include_once '../includes/mainframe_module.php';

$id = filter_input(INPUT_GET, 'id');
$tgtBack = filter_input(INPUT_GET, 'tgtback');

$db = db_connect();
$qKemaskiniBahagian = 'select * from hrbc_bahagian_config where hrbc_id = ' . $id . '';
$resKemaskiniBahagian = $db->query($qKemaskiniBahagian);
$rowKemaskiniBahagian = $resKemaskiniBahagian->fetch_assoc();
?>
<body>
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">						
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3><i class="fa fa-table"></i>Kemaskini Bahagian</h3>
                            </div>
                            <div class="card-body">
                                <a role="button" href="#" class="btn btn-primary" id="tgtback"><i class="fa fa-arrow-left"></i></a>
                                <form id="update">
                                    <input type="hidden" name="action" value="updateBahagian">
                                    <input type="hidden" name="id" value="<?php echo $rowKemaskiniBahagian['hrbc_id'] ?>">
                                    <div class="col-md-6 form-group row">
                                        <label class="col-sm-2 col-form-label">Nama Sektor</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="hrbc_name" name="hrbc_name" placeholder="Sektor" value="<?php echo $rowKemaskiniBahagian['hrbc_name'] ?>" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group row">
                                        <label class="col-sm-2 col-form-label">Aktif ?</label>
                                        <div class="col-sm-2">
                                            <select class="form-control" id="hrbc_is_active" name="hrbc_is_active" autocomplete="off">
                                                <option value="1">Ya</option>
                                                <option value="0">Tidak</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="col-sm-2">
                                            <input type="button" class="btn btn-primary" id="kemaskini" value="Kemaskini">
                                        </div>
                                    </div>
                                </form>
                                <br>
                            </div><!-- end card body -->															
                        </div><!-- end card-->					
                    </div><!-- end col-->			
                </div><!-- end row-->
            </div>
            <!-- END container-fluid -->

        </div>
        <!-- END content -->
    </div>
</body>
<?php include_once '../includes/js.php'; ?>

<script>
    $(document).ready(function () {
        $('#kemaskini').click(function () {
            ajaxindicatorstart('Sila Tunggu');
            $.post('ajax/ajax_bahagian_master.php', $('#update').serialize(), function (result) {
                ajaxindicatorstop();
                if (result == 1) {
                    bootbox.alert('Kemaskini Berjaya', function () {
                        location = "bahagian_master.php"
                    });
                } else {
                    bootbox.alert('Simpan Gagal');
                }
            })
        })

        $('#tgtback').click(function () {
            location = '<?php echo $tgtBack ?>';
        })

    })
</script>

<?php
include_once '../includes/footer.php';
