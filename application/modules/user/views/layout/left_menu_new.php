<div class="col-xs-1">
    <div id="wrapper">
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav menu_list" style="margin-left:0;">
                <li class="sidebar-brand">
                    <a href="#menu-toggle"  id="menu-toggle" style="margin-top:20px;float:right;" > <i class="fa fa-bars " style="font-size:20px !Important;" aria-hidden="true" aria-hidden="true"></i> 
                </li>
                <li>
                    <a href="#">
                        <i class="fa fa-dashboard fa-lg"></i> Dashboard
                    </a>
                </li>

                <li  data-toggle="collapse" data-target="#products" class="collapsed">
                    <a href="#"><i class="fa fa-gift fa-lg"></i> UI Elements  </a>
                </li>
                <ul class="sub-menu collapse" id="products">
                    <li><a href="#">General</a></li>
                    <li><a href="#">Buttons</a></li>
                    <li><a href="#">Tabs & Accordions</a></li>
                    <li><a href="#">Typography</a></li>
                    <li><a href="#">FontAwesome</a></li>
                    <li><a href="#">Slider</a></li>
                    <li><a href="#">Panels</a></li>
                    <li><a href="#">Widgets</a></li>
                    <li><a href="#">Bootstrap Model</a></li>
                </ul>


                <li data-toggle="collapse" data-target="#service" class="collapsed">
                    <a href="#"><i class="fa fa-globe fa-lg"></i> Services <span class="arrow"></span></a>
                </li>  
                <ul class="sub-menu collapse" id="service">
                    <li><a href="#">Panels</a></li>
                    <li><a href="#">Panels</a></li>
                    <li><a href="#">Panels</a></li>
                </ul>
                <li data-toggle="collapse" data-target="#new" class="collapsed">
                    <a href="#"><i class="fa fa-car fa-lg"></i> New <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="new">
                    <li><a href="#">Panels</a></li>
                    <li><a href="#">Panels</a></li>
                    <li><a href="#">Panels</a></li>
                </ul>
                <li>
                    <a href="#">
                        <i class="fa fa-user fa-lg"></i> Profile
                    </a>
                </li>

                <li>
                    <a href="#">
                        <i class="fa fa-users fa-lg"></i> Users
                    </a>
                </li>
            </ul>
        </div>
        </a>

    </div>
</div>
<div class="col-xs-11">
    <?php
    if (isset($_SESSION['pms_err']) && $_SESSION['pms_err'] == 1):
        ?>
        <div class="col-xs-12 alert alert-danger text-center">
            <?php echo $_SESSION['pms_err_message']; ?>
        </div>
        <?php
    elseif (isset($_SESSION['pms_err']) && $_SESSION['pms_err'] == 0):
        ?>
        <div class="col-xs-12 alert alert-success text-center">
            <?php echo $_SESSION['pms_err_message']; ?>
        </div>
        <?php
    endif;
    unset($_SESSION['pms_err']);
    unset($_SESSION['pms_err_message']);
    ?>