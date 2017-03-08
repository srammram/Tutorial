<div class="col-xs-3">
    <div class="nav-side-menu">
        <div class="menu-list">

            <ul id="menu-content" class="menu-content collapse out">
                <li class="active">
                    <a href="#">
                        <i class="fa fa-dashboard fa-lg"></i> Dashboard
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
                        <li  data-toggle="collapse" data-target="#users" class="collapsed ">
                            <a href="#"><i class="fa fa-users fa-lg"></i> Users <span class="arrow"></span></a>
                        </li>
                        <ul class="sub-menu collapse" id="users">
                            <li class=""><a href="<?php echo frontend_url() . 'employee/add'; ?>">Add User</a></li>
                            <li><a href="<?php echo frontend_url() . 'employee'; ?>">Manage Users</a></li>

                        </ul>
                    <?php endif; ?>
                    <?php
                    if (isset($_SESSION['user_access_menus_id']) && (in_array('User Type', $menu_name) || $_SESSION['user_departments_id'] == 9999)):
                        ?>
                        <li  data-toggle="collapse" data-target="#usertype" class="collapsed">
                            <a href="#"><i class="fa fa-user fa-lg"></i> User Type <span class="arrow"></span></a>
                        </li>
                        <ul class="sub-menu collapse" id="usertype">
                            <li class=""><a href="<?php echo frontend_url() . 'usertype/add' ?>">Add User Type</a></li>
                            <li><a href="<?php echo frontend_url() . 'usertype' ?>">Manage User Type</a></li>

                        </ul>
                    <?php endif; ?>
                    <?php
                    if (isset($_SESSION['user_access_menus_id']) && (in_array('Departments', $menu_name) || $_SESSION['user_departments_id'] == 9999)):
                        ?>
                        <li  data-toggle="collapse" data-target="#departments" class="collapsed">
                            <a href="#"><i class="fa fa-desktop fa-lg"></i> Departments<span class="arrow"></span></a>
                        </li>
                        <ul class="sub-menu collapse" id="departments">
                            <li class=""><a href="<?php echo frontend_url() . 'departments/add' ?>">Add Department</a></li>
                            <li><a href="<?php echo frontend_url() . 'departments' ?>">Manage Departments</a></li>

                        </ul>
                    <?php endif; ?>
                    <?php
                    if (isset($_SESSION['user_access_menus_id']) && (in_array('Projects', $menu_name) || $_SESSION['user_departments_id'] == 9999)):
                        ?>
                        <li  data-toggle="collapse" data-target="#projects" class="collapsed">
                            <a href="#"><i class="fa fa-product-hunt fa-lg"></i> Projects<span class="arrow"></span></a>
                        </li>
                        <ul class="sub-menu collapse" id="projects">
                            <li class=""><a href="<?php echo frontend_url() . 'projects/add'; ?>">Add Project</a></li>
                            <li><a href="<?php echo frontend_url() . 'projects/' ?>">Manage Projects</a></li>

                        </ul>
                    <?php endif; ?>
                    <?php
                    if (isset($_SESSION['user_access_menus_id']) && (in_array('Tasks', $menu_name) || $_SESSION['user_departments_id'] == 9999)):
                        ?>
                        <li  data-toggle="collapse" data-target="#tasks" class="collapsed">
                            <a href="#"><i class="fa fa-tasks fa-lg"></i> Tasks<span class="arrow"></span></a>
                        </li>
                        <ul class="sub-menu collapse" id="tasks">
                            <li class=""><a href="#">Add Task</a></li>
                            <li><a href="#">Manage Task</a></li>

                        </ul>
                    <?php endif; ?>
                    <?php
                    if (isset($_SESSION['user_access_menus_id']) && (in_array('Settings', $menu_name) || $_SESSION['user_departments_id'] == 9999)):
                        ?>
                        <li  data-toggle="collapse" >
                            <a href="<?php echo frontend_url() . 'settings' ?>"><i class="fa fa-cog fa-lg"></i> Settings</a>
                        </li>
                    <?php endif; ?>
                    <?php
                    if (isset($_SESSION['user_access_menus_id']) && (in_array('Edit Profile', $menu_name) || $_SESSION['user_departments_id'] == 9999)):
                        ?>
                        <li  data-toggle="collapse" >
                            <a href="<?php echo frontend_url() . 'editprofile' ?>"><i class="fa fa-user fa-lg"></i> Edit Profile</a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<div class="col-xs-9">
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