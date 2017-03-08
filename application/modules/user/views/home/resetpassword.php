<div class="clear" style="clear: both;height:10em"></div>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
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
            <div class="panel panel-login">
                
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                        	
                            <form id="resetpassword-form" action="<?php echo frontend_url() . 'resetpassword'; ?>" method="post" role="form" 
							
							 style="display: block'; " data-parsley-validate="">
                             	<h4 class="text-center">Reset Password</h4>
                                <hr>
                                <?php if(isset($_SESSION['user_forgot'])){ $forgot = $_SESSION['user_forgot']; }else{ $forgot = ''; } ?>
                                <input type="hidden" name="forgot" id="forgot" value="<?php echo $forgot; ?>">
                                <div class="form-group">
                                    <input type="password" name="new_password" id="new_password" tabindex="2" class="form-control" placeholder="New Password" required="" data-parsley-minlength="6">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="comfirm_password" id="comfirm_password" tabindex="2" class="form-control" placeholder="Comfirm Password" required="" data-parsley-minlength="6" >
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="resetpassword-submit" id="resetpassword-submit" tabindex="4" class="form-control btn btn-login" value="Submit">
                                        </div>
                                    </div>
                                </div>
                               

                            </form>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="clear" style="clear: both;height:10em"></div>
