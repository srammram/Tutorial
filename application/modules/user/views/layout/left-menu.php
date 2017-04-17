<?php
$current_url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
?>
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
                    <?php
                    $main = left_menus();
                    $menu_active = menus_active();
                    if (!empty($_SESSION['user_access_menus_id'])) {
                        $access = explode(',', '35,' . $_SESSION['user_access_menus_id']);
                    } else {
                        foreach ($main['menus'] as $m) {
                            $main_left[] = $m['id'];
                        }
                        $access = $main_left;
                    }
                    //for($i=0; $i<count($main['menus']); $i++){
                    foreach ($main['menus'] as $leftmenus) {
                        if (in_array($leftmenus['id'], $access)) {
                            ?>
                            <li class="<?php if ($menu_active[0]['menusids'] == $leftmenus['id']) { ?>active <?php } ?>">
                                <a href="<?php if ($leftmenus['menulink'] == 'none') { ?>javascript:void(0); <?php
                                } else {
                                    echo frontend_url() . $leftmenus['menulink'];
                                }
                                ?>" <?php if (!empty($main['submenus'][$leftmenus['id']])) { ?> class="dropdown-toggle" data-toggle="dropdown" <?php } ?>> 
                                    <span class="menu-icon pull-right hidden-xs showopacity glyphicon material-icons"><i class="fa <?php echo $leftmenus['menuicon']; ?>"></i></span> 
                                    <?php echo $leftmenus['name']; ?> 
                                        <?php if (!empty($main['submenus'][$leftmenus['id']])) { ?><span class="caret"></span><?php } ?>

                                </a> 
                                <ul class="dropdown-menu forAnimate" role="menu">
                                    <?php
                                    for ($j = 0; $j < count($main['submenus'][$leftmenus['id']]); $j++) {
                                        if ($filepath == frontend_url() . $main['submenus'][$leftmenus['id']][$j]['menulink']) {
                                            $substatus = $main['submenus'][$leftmenus['id']][$j]['parent_id'];
                                        }
                                        ?>
                                        <?php if ($_SESSION['user_type_id'] != 6): ?>
                                            <li class="">
                                                <a href="<?php echo frontend_url() . $main['submenus'][$leftmenus['id']][$j]['menulink']; ?>">
                                                    <?php echo $main['submenus'][$leftmenus['id']][$j]['name']; ?>
                                                </a>
                                            </li>
                                        <?php else:
                                            ?>
                                            <?php if ($main['submenus'][$leftmenus['id']][$j]['name'] != 'Assign Task' && $main['submenus'][$leftmenus['id']][$j]['name'] != 'Manage Assign Tasks' && $main['submenus'][$leftmenus['id']][$j]['name'] != 'Add Dependancy' && $main['submenus'][$leftmenus['id']][$j]['name'] != 'Manage Dependency'): ?>
                                                <li class="">
                                                    <a href="<?php echo frontend_url() . $main['submenus'][$leftmenus['id']][$j]['menulink']; ?>">
                                                        <?php echo $main['submenus'][$leftmenus['id']][$j]['name']; ?>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        <?php
                                        endif;
                                        ?>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                            <?php
                        }
                    }
                    ?>
                    <?php if ($_SESSION['user_type_id'] == 5): ?>
                        <li class="">
                            <a href="<?php echo frontend_url() . 'projects/assigned_teamprojects' ?>">
                                <span class="pull-right hidden-xs showopacity glyphicon material-icons">av_timer</span> Assigned Projects
                            </a>
                        </li>
                    <?php endif; ?>
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