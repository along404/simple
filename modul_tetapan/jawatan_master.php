<?php
include_once '../includes/general.php';
if ((!$_SESSION)) {
    header('location:../login.php');
}
include_once '../includes/mainframe_module.php';

$tgtUpdate = 'jawatan_kemaskini.php';
$tgtBack = basename(__FILE__, '.php');
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
                                <h3><i class="fa fa-table"></i> Tetapan Jawatan</h3>
                            </div>
                            <div class="card-body">
                                <form id="save">
                                    <input type="hidden" name="action" value="saveJawatan">
                                    <div class="col-md-6 form-group row">
                                        <label class="col-sm-2 col-form-label">Nama Jawatan</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="hrjc_name" name="hrjc_name" placeholder="Jawatan" autocomplete="off">
                                        </div>
                                        <div class="col-sm-2">
                                            <input type="button" class="btn btn-primary" id="simpan" value="Tambah">
                                        </div>
                                    </div>
                                </form>

                                <br>
                                <div>
                                    <table id="DataTable" class="table table-bordered table-hover display" style="width:100%">
                                    <!--<table id="DataTable" class="" style="width:100%">-->
                                        <thead>
                                            <tr>
                                                <th style="width: 10%; text-align: center">Bil</th>
                                                <th style="text-align: center">Nama Sektor</th>
                                                <th style="width: 10% ;text-align: center">Status</th>
                                                <th style="text-align: center">Kemaskini</th>
                                                <th style="text-align: center">Padam</th>                                          
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            <?php
                                            $db = db_connect();
                                            $qSenarai = 'select * from hrjc_jawatan_config';
                                            $resSenarai = $db->query($qSenarai);
                                            $i = 0;
                                            while ($rowSenarai = $resSenarai->fetch_assoc()) {
                                                $i++;
                                                ?>
                                                <tr>

                                                    <th style="width: 10%; text-align: center"><?php echo $i ?></th>
                                                    <th style="text-align: left"><?php echo $rowSenarai['hrjc_name'] ?></th>                                                       
                                                    <th style="text-align: center"><label class="badge <?php echo labelStatus($rowSenarai['hrjc_is_active']) ?>"><?php echo $rowSenarai['hrjc_is_active'] == 1 ? 'Aktif' : 'Tidak Aktif'; ?></label></th>                                                       
                                                    <th style="width: 10%; text-align: center"><button class="btn btn-success" onclick="updateData('<?php echo $tgtUpdate ?>', '<?php echo $rowSenarai['hrjc_id'] ?>', '<?php echo $tgtBack ?>')"><i class="fa fa-edit"></i></button></th>  
                                                    <th style="width: 10%; text-align: center"><button class="btn btn-danger" onclick="deleteData('ajax/ajax_jawatan_master.php', '<?php echo $rowSenarai['hrjc_id'] ?>')"><i class="fa fa-remove"></i></button></th>  

                                                </tr>
                                            <?php } ?>
                                        </tbody>

                                    </table>
                                </div>
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

        $('#DataTable').DataTable({
//            resposive: true;
        });

        $('#simpan').click(function () {
            ajaxindicatorstart('Sila Tunggu');
            $.post('ajax/ajax_jawatan_master.php', $('#save').serialize(), function (result) {
                ajaxindicatorstop();
                if (result == 1) {
                    bootbox.alert('Simpan Berjaya', function () {
                        location.reload();
                    });
                } else {
                    bootbox.alert('Simpan Gagal');
                }
            })
        })

    })
</script>

<?php
include_once '../includes/footer.php';
