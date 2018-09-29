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
                                <h3><i class="fa fa-table"></i><?php echo 'Calculation' ?></h3>
                            </div>
                            <div class="card-body">
                                <form id="calculation">
                                    <div class="col-md-8 form-group row">
                                        <label class="col-sm-2 col-form-label">Opening Balance</label>
                                        <div class="col-sm-4">
                                            <select type="text" class="form-control select2" id="opening_balance" name="opening_balance" autocomplete="off">
                                                <?php
                                                $db = db_connect();
                                                $qOpening = 'select mr_created_date from mr_data_master
                                                            where mr_is_opening = 1
                                                            GROUP BY mr_created_date
                                                            order by 1';
                                                $resOpening = $db->query($qOpening);
                                                while ($rowOpening = $resOpening->fetch_assoc()) {
                                                    ?>
                                                    <option value="<?php echo $rowOpening['mr_created_date'] ?>"><?php echo DateFromDb($rowOpening['mr_created_date']) ?></option>                                                                                                        
                                                <?php } ?>
                                            </select>
                                        </div>                                     
                                    </div>

                                    <div class="col-md-8 form-group row">
                                        <label class="col-sm-2 col-form-label">Date From</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="date_from" name="date_from" data-provide='singledatepicker' placeholder="Tarikh" autocomplete="off">
                                        </div>                                     
                                    </div>

                                    <div class="col-md-8 form-group row">
                                        <label class="col-sm-2 col-form-label">Date To</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="date_to" name="date_to" data-provide='singledatepicker' placeholder="Tarikh" autocomplete="off">
                                        </div>                                     
                                    </div>

                                    <div class="col-md-8">
                                        <div class="col-sm-2" style="text-align: center">
                                            <input type="button" class="btn btn-primary" id="generate" value="Generate">
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
        $('.select2').select2();

        $('#DataTable').DataTable({
            //            resposive: true;
        });

        $('#generate').click(function () {
            window.open('ajax/ajax_report_calculation.php?date_from=' + $('#date_from').val() + '&date_to=' + $('#date_to').val()+ '&opening_balance=' + $('#opening_balance').val(), '_blank')
        })


    })
</script>

<?php
include_once '../includes/footer.php';
