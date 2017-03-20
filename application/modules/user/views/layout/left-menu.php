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
					for($i=0; $i<count($main['menus']); $i++){
					?>
                   <li class="">
                   		<a href="<?php if($main['menus'][$i]['menulink'] == 'none'){ ?>javascript:void(0); <?php }else{ echo frontend_url().$main['menus'][$i]['menulink']; } ?>" <?php if(!empty($main['submenus'][$i])){ ?> class="dropdown-toggle" data-toggle="dropdown" <?php } ?>> 
                            <span class="menu-icon pull-right hidden-xs showopacity glyphicon material-icons"><i class="fa <?php echo $main['menus'][$i]['menuicon'];  ?>"></i></span> 
                            <?php echo $main['menus'][$i]['name']; ?> 
                            <?php if(!empty($main['submenus'][$i])){ ?><span class="caret"></span><?php } ?>
                        </a> 
                        
                        <?php if(!empty($main['submenus'][$i])){ ?>
                        <ul class="dropdown-menu forAnimate" role="menu">
                        	<?php
							for($j=0; $j<count($main['submenus'][$i]); $j++){
							?>
                            <li class="">
                            	<a href="<?php echo frontend_url().$main['submenus'][$i][$j]['menulink']; ?>">
									<?php echo $main['submenus'][$i][$j]['name']; ?>
                                </a>
                             </li>
                            <?php
							}
							?>
                        </ul>
                        <?php
						}
						?>
                   </li>
                   <?php
					}
				   ?>
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