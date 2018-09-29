<?php
include_once 'config/config.php';
include_once 'includes/header.php';
//include_once 'includes/css.php';
include_once 'connection/db_config.php';
include_once 'includes/function.php';
session_start();
if (($_SESSION)) {
    header('location:index.php');
}
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
<style>
    .header{
        font-size: xx-large;
        font-weight: 900;
        text-align: center;

    }
    body  {
        background-image: url("assets/img/background/bg2.jpg");
        background-color: #cccccc;
        background-size:contain
    }
    .center {
        margin-top: 10%;
        width: 30%;
        border: 3px solid green;
        padding: 12px;
    }
    .empty-space{
        margin-top: 10%;
    }


</style>


<body >
    <div class="container login-panel center border-radius" style="background-color: white">
        <div style="text-align: center">
            <label style="padding:10px;" class="header">SISTEM KEDATANGAN</label>      
        </div>

        <table class="table">
            <tr>
                <td>
                    <div style="text-align: center">
                        <label style="padding:20px; font-size: xx-large">Log Masuk</label>      
                    </div>
                    <form class="form-horizontal" id="login" method="post">  
                        <input type="hidden" name="action" value="login">
                        <div class="form-group">
                            <label class="col-sm-4" for="email"><b>ID Pengguna:</b></label>
                            <div class="col-md-12">
                                <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4" for="pwd"><b>Kata Laluan:</b></label>
                            <div class="col-md-12">          
                                <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
                            </div>
                        </div>
                        <div class="form-horizontal" style="text-align: right">
                            <a style="cursor: pointer">Forget Password?</a>              
                        </div>
                        <div class="form-horizontal empty-space" style="text-align: center">
                            <input type="button" id="submit" class="btn btn-primary" value="Login">
                            <input type="button" id="signUp" class="btn btn-primary" value="Sign Up">
                        </div>
                    </form>
                </td>
            </tr>
        </table>
    </div>

</body>
<!------------------------------------------------------------------Template Plugin ------------------------------------------------------------------>

<script src="assets/js/modernizr.min.js"></script>
<script src="assets/js/jquery.min.js"></script>
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
        $('#submit').click(function (e) {
//            bootbox.alert('1');
            e.preventDefault();
            ajaxindicatorstart('Sila Tunggu');
            $.post("ajax/ajax_login.php", $("#login").serialize(), function (result) {
                ajaxindicatorstop();
                if (result === "1") {
                    bootbox.alert("Login Success", function () {
                        location = 'index.php';
                    });
                } else if (result === "0") {
                    bootbox.alert("Username/Password not exist");
                } else {
                    bootbox.alert(result);
                }
            });
        });

        $('#signUp').click(function () {
            location = 'sign_up.php';
        })
    })
</script>
