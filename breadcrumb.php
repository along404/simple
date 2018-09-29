<?php
//if ($PBT_SYSTEM_PARAMETER['ShowBreadcrumb'] == "1") {
//    
?>
<style>
    .breadcrumb {
        padding: 0px;
        padding-top: 9px !important;
        padding-bottom: 5px !important;
        line-height: 0.5px !important;
    }
    .horizontalBreadCrumb {
        margin-bottom:5px;
    }
    hr {
        margin-top:5px;
    }
</style>
<div id="page-heading" class="animated fadeInDown">
    <ol class="breadcrumb">
<?php echo breadcrumbs(); ?>
    </ol>
</div>
<hr class="horizontalBreadCrumb">
    <?php
//}