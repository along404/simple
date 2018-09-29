
<div id="main">
    <!-- top bar navigation -->
    <div class="headerbar">

        <!-- LOGO -->
        <div class="headerbar-left">
            <a href="../index.php" class="logo"><img alt="logo" src="../assets/images/logo.png" /> <span>Admin</span></a>
        </div>

        <nav class="navbar-custom">

            <ul class="list-inline float-right mb-0">

                <li class="list-inline-item dropdown notif">
                    <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        Hello, <?php echo $_SESSION['hrsm_nickname'] ?>
                    </a>
                    <div border="1" class="dropdown-menu dropdown-menu-right profile-dropdown" style="width: 200px">
                        <!-- item-->
                        <a  class="dropdown-item notify-item">
                            <i class="fa fa-user-circle" ></i> <span>Profile</span>
                        </a>
                        <a  class="dropdown-item notify-item" id="logout">
                            <i class="fa fa-power-off" ></i> <span>Logout</span>
                        </a>
                    </div>
                </li>

            </ul>
            <ul class="list-inline menu-left mb-0">
                <li class="float-left">
                    <button class="button-menu-mobile open-left">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                </li>                        
            </ul>

        </nav>

    </div>
    <!-- End Navigation -->






    <!-- Left Sidebar -->
    <div class="left main-sidebar">

        <div class="sidebar-inner leftscroll">

            <div id="sidebar-menu">

                <ul>
                    <?php
                    $db = db_connect();
                    $qlevel1 = "select * from sysm_sidebar_master where sysm_parent_id= '" . $_SESSION['sysm_menu_id'] . "' order by sysm_order";
                    $reslevel1 = $db->query($qlevel1);
                    while ($rowlevel1 = $reslevel1->fetch_assoc()) {
                        ?>
                        <li class="submenu">
                            <a href="<?php echo $rowlevel1['sysm_url'] ?>"><i class="fa <?php echo $rowlevel1['sysm_icon'] ?>"></i><span><?php echo $rowlevel1['sysm_name'] ?></span></a>

                            <ul>
                                <?php
                                $db = db_connect();
                                $qlevel2 = "select * from sysm_sidebar_master where sysm_parent_id= " . $rowlevel1['sysm_menu_id'] . " order by sysm_order";
                                $reslevel2 = $db->query($qlevel2);
                                while ($rowlevel2 = $reslevel2->fetch_assoc()) {
                                    ?>
                                    <li>
                                        <a href="<?php echo $rowlevel2['sysm_url'] ?>"><span><?php echo $rowlevel2['sysm_name'] ?></span></a>
                                    </li>                                    
                                <?php } ?>
                            </ul>

                        </li>   
                    <?php } ?>
                </ul>

                <div class="clearfix"></div>

            </div>

            <div class="clearfix"></div>

        </div>

    </div>
    <!-- End Sidebar -->
