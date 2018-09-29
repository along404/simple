<?php
include_once '../includes/general.php';
if ((!$_SESSION)) {
    header('location:../login.php');
}
$modul_id = $_SESSION['sysm_menu_id'];
include_once '../includes/mainframe_module.php';
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
                                <h3><i class="fa fa-table"></i>Sampel Data</h3>
                            </div>
                            <div class="card-body">
                                <form id="saveSampleData">
                                    <input type="hidden" name="action" value="save">
                                    <div class="col-md-6 form-group row">
                                        <label class="col-sm-2 col-form-label">Jenis Data</label>
                                        <div class="col-sm-6">
                                            <select class="form-control select2" id="mr_data_type" name="mr_sample_type">    
                                                <option value="1">Stock</option>                                                
                                                <option value="2">Currency</option>                                             
                                            </select>
                                        </div>                                     
                                    </div>
                                    <div class="col-md-6 form-group row">
                                        <label class="col-sm-2 col-form-label">Unit Ukuran</label>
                                        <div class="col-sm-6">
                                            <select class="form-control select2" id="mr_sypd_value" name="mr_sypd_value">  
                                                <?php
                                                $db = db_connect();
                                                $qUkuran = 'select * from sypd_parameter_detail where sypd_sypm_id = 1';
                                                $resUkuran = $db->query($qUkuran);
                                                while ($rowUkuran = $resUkuran->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?php echo $rowUkuran['sypd_value'] ?>"><?php echo $rowUkuran['sypd_name'] ?></option>                                                                                                        
                                                <?php } ?>
                                            </select>
                                        </div>                                     
                                    </div>
                                    <div class="col-md-6 form-group row">
                                        <label class="col-sm-2 col-form-label">Data <i>a</i></label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="mr_data_a" name="mr_data_a" placeholder="Data a" autocomplete="off">
                                        </div>                                     
                                    </div>
                                    <div class="col-md-6 form-group row">
                                        <label class="col-sm-2 col-form-label">Data <i>b</i></label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="mr_data_b" name="mr_data_b" placeholder="Data b" autocomplete="off">
                                        </div>                                     
                                    </div>
                                    <div class="col-md-6 form-group row">
                                        <label class="col-sm-2 col-form-label">Tarikh</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" id="mr_created_date" name="mr_created_date" data-provide='singledatepicker' placeholder="Tarikh" autocomplete="off">
                                        </div>                                     
                                    </div>
                                    <div class="col-md-6 form-group row">
                                        <label class="col-sm-2 col-form-label">Baki Awal?</label>
                                        <div class="col-sm-2">
                                            <select type="text" class="form-control" id="mr_is_opening" name="mr_is_opening" placeholder="Sila Pilih" autocomplete="off">
                                                <option value="0">Tidak</option>   
                                                <option value="1">Ya</option>   
                                            </select>
                                        </div>                                     
                                    </div>
                                    <div class="col-md-6">
                                        <div class="col-sm-2" style="text-align: center">
                                            <input type="button" class="btn btn-primary" id="simpan" value="Tambah">
                                        </div>
                                    </div>
                                </form>
                                <br>                                
                            </div><!-- end card body -->
                            <div class="card-header">
                                <h3><i class="fa fa-table"></i>Senarai Data</h3>
                            </div>
                            <div class="card-body">

                                <div>
                                    <table id="DataTable" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center">Bil</th>
                                                <th style="text-align: center">Currency</th>
                                                <th style="text-align: center">Data <i>a</i></th>
                                                <th style="text-align: center">Data <i>b</i></th>
                                                <th style="text-align: center">Sample Type</th>
                                                <th style="text-align: center">Tarikh</th>
                                                <th style="text-align: center">Baki Awal?</th>
                                                <th style="text-align: center">Kemaskini</th>
                                                <th style="text-align: center">Padam</th>                                          
                                            </tr>
                                        </thead> 
                                        <tbody>
                                            <?php
                                            $qData = 'select *,if(mr_is_opening=1,1,2)ordering  from mr_data_master '
                                                    . 'inner join sypd_parameter_detail on mr_sypd_value = sypd_value and sypd_sypm_id = 1 '
                                                    . 'order by ordering,mr_created_date ';
                                            $resData = $db->query($qData);
                                            $i = 0;
                                            while ($rowData = $resData->fetch_assoc()) {
                                                $i++;
                                                ?>
                                                <tr>
                                                    <th style="width: 10%; text-align: center"><?php echo $i ?></th>
                                                    <th style="width: 30%; text-align: left"><?php echo $rowData['sypd_name'] ?></th>
                                                    <th style="width: 15%;text-align: right"><?php echo $rowData['mr_data_a'] ?></th>                                                       
                                                    <th style="width: 15%;text-align: right"><?php echo $rowData['mr_data_b'] ?></th>                                                       
                                                    <th style="width: 20%;text-align: center"><?php echo $rowData['mr_sample_type'] == 1 ? 'Stock' : 'Currency'; ?></th>                                                       
                                                    <th style="width: 20%;text-align: center"><?php echo DateFromDb($rowData['mr_created_date']) ?></th>                                                       
                                                    <th style="width: 20%;text-align: center"><?php echo $rowData['mr_is_opening'] == 1 ? 'Ya' : 'Tidak'; ?></th>                                                       
                                                    <th style="width: 10%; text-align: center"><button class="btn btn-success"><i class="fa fa-edit"></i></button></th>  
                                                    <th style="width: 10%; text-align: center"><button class="btn btn-danger"><i class="fa fa-remove"></i></button></th>  
                                                </tr>
                                            <?php } ?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
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
            $.post('ajax/ajax_pengiraan_master.php', $('#saveSampleData').serialize(), function (result) {
                ajaxindicatorstop();
                if (result == 1) {
                    bootbox.alert('Simpan Berjaya', function () {
                        location.reload();
                    });
                } else {
                    bootbox.alert('Simpan Gagal');
//                    alert(result);
                }
            })
        })


    })
</script>

<?php
include_once '../includes/footer.php';
