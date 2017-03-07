<!DOCTYPE html>
<html>
<head>
    <?php echo $this->load->view('layout/header');?>
</head>

<body class="flat-blue register-page">
 <div class="container">
        <div class="register-box">
            <div>
                <div class="register-form row">
                    <div class="col-sm-12 text-center reg-header">
                      <?php /*?>  <i class="login-logo fa fa-connectdevelop fa-5x"></i> <?pph */?>
                        <a class="landing_logo logo" title="pos"><img src="<?php echo load_lib()?>theme/images/site-logo.png" /></a>
                    </div>
                    
                    <div class="col-sm-12">
                        <div class="alert alert-danger log_alert" role="alert" style="display:none;">
</div>              
                        <div id="login_frm" style="">
                            <div class="reg-body">
                            <h2 class="login_title">Create on account</h2>
							<ul class=" alert_msg  alert-danger  alert container_alert" style="display: none;">
							
							</ul>	
					<?php echo form_open_multipart(frontend_url().'user/register',' class="" id="user_registration_form" ' );?>
                        <div class="control">
						<?php  echo form_input('user_name',set_value('user_name'),' class="form-control required" placeholder="Full Name" ');?>
						</div>

						<div class="control">
						<?php  echo form_input('user_username',set_value('user_username'),' class="form-control required" minlength="'.get_label('username_minlength').'"  placeholder="Username"  ');?>
						
						</div>	
						 <div class="control">
						 <?php echo  form_password('user_password','','class="form-control required" placeholder="Password" minlength="'.PASSWORD_LENGHT.'" ');?>

						</div>	
						<div class="control">
						<?php  echo form_input('user_email',set_value('user_email'),' class="form-control required email"  placeholder="Email" ');?>
						</div>

						<div class="control">
                                <div class="input_box">
                                    <div class="custom_browsefile">
                                        <?php  echo form_upload('user_profile_image')?>
                                        <span class="result_browsefile"><span class="brows"></span>+ Upload Profile Image</span>
                                    </div>
                                </div>
                            </div>
						 <div class="control"><div class="input_box"><?php  echo form_textarea('user_info',set_value('user_info'),'class="form-control" placeholder="About Text" ' )?>
						</div>
						<div class="control">
						<?php  echo form_input('user_referral_id',$referral_code,' class="form-control" placeholder="Enter Referral Code" ');?>
						</div>
					                       
                        <div class="form-group">
                            <div class=" btn_submit_div">
                                <button type="submit" class="btn btn-primary " name="submit"
                                    value="Submit"><?php echo get_label('submit');?></button>
                                <a class="btn btn-info" href="<?php echo base_url();?>"><?php echo get_label('cancel');?></a>
                            </div>
                        </div>
					
					<?php
					echo form_hidden ( 'action', 'Register' );
					echo form_close ();
					?>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
	</div>
	<!-- Javascript Libs -->
	 <?php echo $this->load->view('layout/footer-includes'); ?>

</body>
</html>
