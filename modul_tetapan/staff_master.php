<?php
include_once '../includes/general.php';
if ((!$_SESSION)) {
    header('location:../login.php');
}
include_once '../includes/mainframe_module.php';
$db = db_connect();

$tgtUpdate = 'staff_kemaskini.php';
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
                                <h3><i class="fa fa-table"></i>Senarai Staff</h3>
                            </div>
                            <div class="card-body">                                
                                <form id="save">  
                                    <input type="hidden" name="action" value="saveStaff">

                                    
                                    <div class="col-md-6 form-group row">
                                        <label class="col-sm-2 col-form-label">No ID Staf</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="hrsm_staff_id" name="hrsm_staff_id" placeholder="ID Staf" autocomplete="off">
                                        </div>                                        
                                    </div>
                                    <div class="col-md-6 form-group row">
                                        <label class="col-sm-2 col-form-label">Nama Staf</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="hrsm_name" name="hrsm_name" placeholder="Nama Staff" autocomplete="off">
                                        </div>                                        
                                    </div>

                                    <div class="col-md-6 form-group row">
                                        <label class="col-sm-2 col-form-label">Jawatan</label>
                                        <div class="col-sm-6">
                                            <select type="text" class="form-control select2" id="hrsm_hrjc_id" name="hrsm_hrjc_id"  autocomplete="off">
                                                <?php
                                                $qSenaraiJawatan = 'SELECT * FROM hrjc_jawatan_config';
                                                $resSenaraiJawatan = $db->query($qSenaraiJawatan);
                                                while ($rowSenaraiJawatan = $resSenaraiJawatan->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?php echo $rowSenaraiJawatan['hrjc_id'] ?>"><?php echo $rowSenaraiJawatan['hrjc_name'] ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-6 form-group row">
                                        <label class="col-sm-2 col-form-label">Bahagian</label>
                                        <div class="col-sm-6">
                                            <select type="text" class="form-control select2" id="hrsm_hrbc_id" name="hrsm_hrbc_id"  autocomplete="off">
                                                <?php
                                                $qSenaraiBahagian = 'SELECT * FROM hrbc_bahagian_config';
                                                $resSenaraiBahagian = $db->query($qSenaraiBahagian);
                                                while ($rowSenaraiBahagian = $resSenaraiBahagian->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?php echo $rowSenaraiBahagian['hrbc_id'] ?>"><?php echo $rowSenaraiBahagian['hrbc_name'] ?></option>
                                                <?php } ?>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="button" class="btn btn-primary" id="simpan" value="Tambah">
                                    </div>
                                </form>

                                <br>
                                <div>
                                    <table id="DataTable" class="table table-bordered table-hover display" style="width:100%">
                                    <!--<table id="DataTable" class="" style="width:100%">-->
                                        <thead>
                                            <tr>
                                                <th style="width: 10%; text-align: center">Bil</th>
                                                <th style="text-align: center">ID Staf</th>
                                                <th style="text-align: center">Nama Staf</th>
                                                <th style="text-align: center">Bahagian</th>
                                                <th style="text-align: center">Jawatan</th>                                                
                                                <th style="text-align: center">Kemaskini</th>
                                                <th style="text-align: center">Padam</th>                                          
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            <?php
                                            $db = db_connect();
                                            $qSenarai = 'select * from hrsm_staff_master
                                                        inner join hrjc_jawatan_config on hrsm_hrjc_id = hrjc_id
                                                        inner join hrbc_bahagian_config on hrsm_hrbc_id = hrbc_id';
                                            $resSenarai = $db->query($qSenarai);
                                            $i = 0;
                                            while ($rowSenarai = $resSenarai->fetch_assoc()) {
                                                $i++;
                                                ?>
                                                <tr>

                                                    <th style="width: 10%; text-align: center"><?php echo $i ?></th>
                                                    <th style="text-align: left"><?php echo $rowSenarai['hrsm_staff_id'] ?></th>                                                       
                                                    <th style="text-align: left"><?php echo $rowSenarai['hrsm_name'] ?></th>                                                       
                                                    <th style="text-align: left"><?php echo $rowSenarai['hrbc_name'] ?></th>                                                       
                                                    <th style="text-align: left"><?php echo $rowSenarai['hrjc_name'] ?></th>                                                                                                           
                                                    <th style="width: 10%; text-align: center"><button class="btn btn-success" onclick="updateData('<?php echo $tgtUpdate ?>', '<?php echo $rowSenarai['hrsm_id'] ?>', '<?php echo $tgtBack ?>')"><i class="fa fa-edit"></i></button></th>  
                                                    <th style="width: 10%; text-align: center"><button class="btn btn-danger" onclick="deleteData('ajax/ajax_jawatan_master.php', '<?php echo $rowSenarai['hrsm_id'] ?>')"><i class="fa fa-remove"></i></button></th>  

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
        $('.select2').select2();
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
