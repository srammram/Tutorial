<div class="col-xs-3">

    <div class="nav-side-menu">
        <div class="menu-list">
            <ul id="menu-content" class="menu-content collapse out">

                <li class="active">
                    <a href="<?php echo frontend_url() . 'dashboard'; ?>">
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
                        <?php if ($_SESSION['user_type_id'] != 5): ?>
                            <li  data-toggle="collapse" data-target="#projects" class="collapsed">
                                <a href="#"><i class="fa fa-product-hunt fa-lg"></i> Projects<span class="arrow"></span></a>
                            </li>
                            <ul class="sub-menu collapse" id="projects">
                                <li class=""><a href="<?php echo frontend_url() . 'projects/add'; ?>">Add Project</a></li>
                                <li><a href="<?php echo frontend_url() . 'projects/' ?>">Manage Projects</a></li>

                            </ul>
                        <?php else: ?>
                            <li   class="collapsed">
                                <a href="<?php echo frontend_url() . 'projects/assigned_teamprojects'; ?>"><i class="fa fa-product-hunt fa-lg"></i>Assigned Projects</a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php
                    if (isset($_SESSION['user_access_menus_id']) && (in_array('Tasks', $menu_name) || $_SESSION['user_departments_id'] == 9999)):
                        ?>
                        <li  data-toggle="collapse" data-target="#tasks" class="collapsed">
                            <a href="#"><i class="fa fa-tasks fa-lg"></i> Tasks<span class="arrow"></span></a>
                        </li>
                        <ul class="sub-menu collapse" id="tasks">
                            <li class=""><a href="<?php echo frontend_url() . 'tasks/asign'; ?>">Assign Task</a></li>
                            <li class=""><a href="<?php echo frontend_url() . 'tasks/manage_asign_task'; ?>">Manage Assigned Task</a></li>
                            <li class=""><a href="<?php echo frontend_url() . 'tasks/add_new_task'; ?>">Add Task</a></li>
                            <li><a href="<?php echo frontend_url() . 'tasks/manage_new_task'; ?>">Manage Tasks</a></li>

                        </ul>
                    <?php endif; ?>
                    <?php
                    if (isset($_SESSION['user_access_menus_id']) && (in_array('Settings', $menu_name) || $_SESSION['user_departments_id'] == 9999)):
                        ?>

                        <li  data-toggle="collapse" data-target="#setting" class="collapsed ">
                            <a href="#"><i class="fa fa-cog fa-lg"></i> Settings <span class="arrow"></span></a>
                        </li>
                        <ul class="sub-menu collapse" id="setting">
                            <li><a href="<?php echo frontend_url() . 'profile'; ?>">Profile Edit</a></li>
                            <li><a href="<?php echo frontend_url() . 'changepassword'; ?>">Change Password</a></li>
                            <li><a href="<?php echo frontend_url() . 'emailchange'; ?>">Email Change</a></li>
                            <li><a href="<?php echo frontend_url() . 'mobilechange'; ?>">Mobile Change</a></li>
                        </ul>
                    <?php endif; ?>

                    <?php
                    if (isset($_SESSION['user_access_menus_id']) && (in_array('Edit Profile', $menu_name) || $_SESSION['user_departments_id'] == 9999)):
                        ?>
                        <li  data-toggle="collapse" data-target="#holiday" class="collapsed ">
                            <a href="#"><i class="fa fa-calendar fa-lg"></i> Holidays <span class="arrow"></span></a>
                        </li>
                        <ul class="sub-menu collapse" id="holiday">
                            <li><a href="<?php echo frontend_url() . 'holidays/add'; ?>">Add Holidays</a></li>
                            <li><a href="<?php echo frontend_url() . 'holidays'; ?>">Manage Holidays</a></li>

                        </ul>
                    <?php endif; ?>
                    <?php
                    if (isset($_SESSION['user_access_menus_id']) && (in_array('Edit Profile', $menu_name) || $_SESSION['user_departments_id'] == 9999)):
                        ?>
                        <li  data-toggle="collapse" data-target="#email" class="collapsed ">
                            <a href="#"><i class="fa fa-envelope fa-lg"></i> Email Setting <span class="arrow"></span></a>
                        </li>
                        <ul class="sub-menu collapse" id="email">
                            <li><a href="<?php echo frontend_url() . 'emailsetting/add'; ?>">Add Email Setting</a></li>
                            <li><a href="<?php echo frontend_url() . 'emailsetting'; ?>">Manage Email Setting</a></li>

                        </ul>
                    <?php endif; ?>
                    <?php
                    if (isset($_SESSION['user_access_menus_id']) && (in_array('Edit Profile', $menu_name) || $_SESSION['user_departments_id'] == 9999)):
                        ?>
                        <li  data-toggle="collapse" data-target="#sms" class="collapsed ">
                            <a href="#"><i class="fa fa-mobile fa-lg"></i> SMS Setting <span class="arrow"></span></a>
                        </li>
                        <ul class="sub-menu collapse" id="sms">
                            <li><a href="<?php echo frontend_url() . 'smssetting/add'; ?>">Add SMS Setting</a></li>
                            <li><a href="<?php echo frontend_url() . 'smssetting'; ?>">Manage SMS Setting</a></li>

                        </ul>
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