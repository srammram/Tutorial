<div class="col-xs-1" style="margin: 0px; padding: 0px;">
    <nav class="navbar navbar-m2p sidebar" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <P>PMS</P>
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
                <ul class="nav navbar-nav left_menu1">

                    <li class="active open">
                        <a href="<?php echo frontend_url() . 'dashboard'; ?>">
                            <i class="fa fa-dashboard"></i> Dashboard
                        </a>
                    </li>
                    <?php
                    if (isset($_SESSION['user_departments_id'])):
                        $menu_id = explode(',', $_SESSION['user_access_menus_id']);
                        $menudetails = json_decode($_SESSION['user_access_menus_details'], TRUE);
                        $i = 0;
                        if (!empty($menudetails['menu_details'])):
                            foreach ($menudetails['menu_details'] as $menudet):
                                $menu_name[] = $menudetails['menu_details'][$i]['name'];
                                $menu_slug[] = $menudetails['menu_details'][$i]['slug'];
                                $menu_id[] = $menudetails['menu_details'][$i]['id'];
                                $i++;
                            endforeach;
                        else:
                            $menu_name[] = '';
                            $menu_slug[] = '';
                            $menu_id[] = '';

                        endif;
                        ?>
                        <?php
                        if (isset($_SESSION['user_access_menus_id']) && (in_array('Users', $menu_name) || $_SESSION['user_departments_id'] == 9999)):
                            ?>
                            <li class="">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="menu-icon pull-right hidden-xs showopacity glyphicon material-icons"><i class="fa fa-user"></i></span>
                                    Users <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu forAnimate" role="menu">
                                    <li class=""><a href="<?php echo frontend_url() . 'employee/add'; ?>">Add User</a></li>
                                    <li><a href="<?php echo frontend_url() . 'employee'; ?>">Manage Users</a></li>
                                </ul>
                            </li>

                        <?php endif; ?>
                        <?php
                        if (isset($_SESSION['user_access_menus_id']) && (in_array('User Type', $menu_name) || $_SESSION['user_departments_id'] == 9999)):
                            ?>
                            <li class="">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="menu-icon pull-right hidden-xs showopacity glyphicon material-icons">burst_mode</span>
                                    User Type <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu forAnimate" role="menu">
                                    <li class=""><a href="<?php echo frontend_url() . 'usertype/add' ?>">Add User Type</a></li>
                                    <li><a href="<?php echo frontend_url() . 'usertype' ?>">Manage User Type</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        <?php
                        if (isset($_SESSION['user_access_menus_id']) && (in_array('Departments', $menu_name) || $_SESSION['user_departments_id'] == 9999)):
                            ?>
                            <li class="">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="menu-icon pull-right hidden-xs showopacity glyphicon material-icons"><i class="fa fa-user"></i></span>
                                    Departments <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu forAnimate" role="menu">
                                    <li class=""><a href="<?php echo frontend_url() . 'departments/add' ?>">Add Department</a></li>
                                    <li><a href="<?php echo frontend_url() . 'departments' ?>">Manage Departments</a></li>

                                </ul>
                            </li>
                        <?php endif; ?>
                        <?php
                        if (isset($_SESSION['user_access_menus_id']) && (in_array('Projects', $menu_name) || $_SESSION['user_departments_id'] == 9999)):
                            ?>
                            <?php if ($_SESSION['user_type_id'] != 5): ?>
                                <li class="">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <span class="menu-icon pull-right hidden-xs showopacity glyphicon material-icons">burst_mode</span>
                                        Projects <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu forAnimate" role="menu">
                                        <li class=""><a href="<?php echo frontend_url() . 'projects/add'; ?>">Add Project</a></li>
                                        <li><a href="<?php echo frontend_url() . 'projects/' ?>">Manage Projects</a></li>

                                    </ul>
                                </li>
                            <?php else: ?>
                                <li class="">
                                    <a href="<?php echo frontend_url() . 'projects/assigned_teamprojects'; ?>">
                                        <span class="menu-icon pull-right hidden-xs showopacity glyphicon material-icons"><i class="fa fa-product-hunt"></i></span>
                                        Assigned Projects 

                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php
                        if (isset($_SESSION['user_access_menus_id']) && (in_array('Tasks', $menu_name) || $_SESSION['user_departments_id'] == 9999)):
                            ?>
                            <li class="">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="menu-icon pull-right hidden-xs showopacity glyphicon material-icons"><i class="fa fa-tasks"></i></span>
                                    Tasks <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu forAnimate" role="menu">
                                    <?php if ($_SESSION['user_type_id'] != 6): ?>
                                        <li class=""><a href="<?php echo frontend_url() . 'tasks/asign'; ?>">Assign Task</a></li>
                                        <li class=""><a href="<?php echo frontend_url() . 'tasks/manage_asign_task'; ?>">Manage Assigned Task</a></li>
                                    <?php endif; ?>
                                    <li class=""><a href="<?php echo frontend_url() . 'tasks/add_new_task'; ?>">Add Task</a></li>
                                    <li><a href="<?php echo frontend_url() . 'tasks/manage_new_task'; ?>">Manage Tasks</a></li>

                                </ul>
                            </li>
                        <?php endif; ?>
                        <?php
                        if (isset($_SESSION['user_access_menus_id']) && (in_array('Settings', $menu_name) || $_SESSION['user_departments_id'] == 9999)):
                            ?>

                            <li class="">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="menu-icon pull-right hidden-xs showopacity glyphicon material-icons"><i class="fa fa-cog"></i></span>
                                    Settings <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu forAnimate" role="menu">
                                    <li><a href="<?php echo frontend_url() . 'profile'; ?>">Profile Edit</a></li>
                                    <li><a href="<?php echo frontend_url() . 'changepassword'; ?>">Change Password</a></li>
                                    <li><a href="<?php echo frontend_url() . 'emailchange'; ?>">Email Change</a></li>
                                    <li><a href="<?php echo frontend_url() . 'mobilechange'; ?>">Mobile Change</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <?php
                        if (isset($_SESSION['user_access_menus_id']) && (in_array('Edit Profile', $menu_name) || $_SESSION['user_departments_id'] == 9999)):
                            ?>
                            <li class="">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="menu-icon pull-right hidden-xs showopacity glyphicon material-icons"><i class="fa fa-tree"></i></span>
                                    Holidays <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu forAnimate" role="menu">
                                    <li><a href="<?php echo frontend_url() . 'holidays/add'; ?>">Add Holidays</a></li>
                                    <li><a href="<?php echo frontend_url() . 'holidays'; ?>">Manage Holidays</a></li>

                                </ul>
                            </li>
                        <?php endif; ?>
                        <?php
                        if (isset($_SESSION['user_access_menus_id']) && (in_array('Edit Profile', $menu_name) || $_SESSION['user_departments_id'] == 9999)):
                            ?>
                            <li class="">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="menu-icon pull-right hidden-xs showopacity glyphicon material-icons"><i class="fa fa-bar-chart"></i></span>
                                    Menus <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu forAnimate" role="menu">
                                    <li><a href="<?php echo frontend_url() . 'menus/add'; ?>">Add Menus</a></li>
                                    <li><a href="<?php echo frontend_url() . 'menus'; ?>">Manage Menus</a></li>

                                </ul>
                            </li>
                        <?php endif; ?>
                        <?php
                        if (isset($_SESSION['user_access_menus_id']) && (in_array('Edit Profile', $menu_name) || $_SESSION['user_departments_id'] == 9999)):
                            ?>
                            <li class="">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="menu-icon pull-right hidden-xs showopacity glyphicon material-icons"><i class="fa fa-envelope"></i></span>
                                    Email Settings <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu forAnimate" role="menu">
                                    <li><a href="<?php echo frontend_url() . 'emailsetting/add'; ?>">Add Email Setting</a></li>
                                    <li><a href="<?php echo frontend_url() . 'emailsetting'; ?>">Manage Email Setting</a></li>

                                </ul>
                            </li>
                        <?php endif; ?>
                        <?php
                        if (isset($_SESSION['user_access_menus_id']) && (in_array('Edit Profile', $menu_name) || $_SESSION['user_departments_id'] == 9999)):
                            ?>
                            <li class="">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="menu-icon pull-right hidden-xs showopacity glyphicon material-icons"><i class="fa fa-mobile"></i></span>
                                    SMS Settings <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu forAnimate" role="menu">
                                    <li><a href="<?php echo frontend_url() . 'smssetting/add'; ?>">Add SMS Setting</a></li>
                                    <li><a href="<?php echo frontend_url() . 'smssetting'; ?>">Manage SMS Setting</a></li>

                                </ul>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                    <li class="">
                        <a href="<?php echo frontend_url() . 'reporting'; ?>">
                            <span class="menu-icon pull-right hidden-xs showopacity glyphicon material-icons"><i class="fa fa-bar-chart"></i></span>
                            Reporting
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>    
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