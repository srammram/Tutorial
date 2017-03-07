<div class="container-fluid">
	<div class="side-body">
	   <?php echo get_template('layout/notifications','')?>
		<div class="page-title">
			<span class="title"><?php echo $module_labels; ?></span>
        </div>

		<div class="row">
			<div class="col-sm-12 col-xs-12">
			<div class="col-sm-5">
			<div class="card ">				
					<div class="card-body">
					 <div class="row">
                        <div class="col-sm-12">
                            <a href="#">
                                <div class="card red summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-user fa-4x"></i>
                                        <div class="content">
                                            <div class="title">50</div>
                                            <div class="sub-title">Rewards For New User</span></div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
						 <div class="col-sm-12">
                            <a href="#">
                                <div class="card blue summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-share-alt fa-4x"></i>
                                        <div class="content">
                                            <div class="title">20</div>
                                            <div class="sub-title">Get Rewards to Each Sharing the Referral to Your Friends</div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-12">
                            <a href="#">
                                <div class="card yellow summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-users fa-4x"></i>
                                        <div class="content">
                                            <div class="title">30</div>
                                            <div class="sub-title">Get Rewards to Each Referral Friends registered by Using Your Referral Code</div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-sm-12">
                            <a href="#">
                                <div class="card green summary-inline">
                                    <div class="card-body">
                                        <i class="icon fa fa-sign-in fa-4x"></i>
                                        <div class="content">
                                            <div class="title">10</div>
                                            <div class="sub-title">Every Sign In Get Rewards</div>
                                        </div>
                                        <div class="clear-both"></div>
                                    </div>
                                </div>
                            </a>
                        </div>
                       
                    </div>
					</div>
			</div>		
			</div>
			<div class="col-sm-7">
				<div class="card ">
				
					<div class="card-body">
					<h3>Share Referral Code With Yours !</h3>
					<br />
                        <ul class=" alert_msg  alert-danger  alert container_alert" style="display: none;">
						</ul>	
						
					  <?php echo form_open(frontend_url().$module."/sendreferral",array("id"=>"referral_form","class"=>"form-horizontal referral_form"));?>
						
							<div class="field_wrapper">
								
								<div class="form-group">
									<div class="col-sm-4">
									<input class="form-control required" type="text" name="friend_name[]" value="" Placeholder="Name" />
									</div>
									<div class="col-sm-5">
									<input type="text" name="friend_email[]" value="" class="form-control required email" Placeholder="Email" />
									</div>			
								
									<a href="javascript:void(0);" class="add_button" title="Add field"><i class="fa fa-user-plus fa-2x"></i> Add more Friends</a>
								</div>	
								
							</div>
							<div class="form-group">
                            <div class=" col-sm-<?php echo get_form_size();?>  btn_submit_div">
                                <button type="submit" class="btn btn-primary " name="submit"
                                    value="Submit"><?php echo get_label('send');?></button>
                                <a class="btn btn-info" href="<?php echo frontend_url().$module;?>"><?php echo get_label('cancel');?></a>
                            </div>
							</div>
						
						<input  type="hidden"  name="postaction"  id="actionid" value=""> 
						<input  type="hidden"  name="changeId"  id="changeId"  value="">
											
						<?php
							echo form_hidden ( 'action', 'send_referral' );
							echo form_close();
						?>  
                                             
                    </div>
				</div>
				</div>
			</div>
		</div>

	</div>
</div>

<script>
/*  load initial content.. */
$(window).load(function(){
	  get_content({paging:"true"});
});
</script>