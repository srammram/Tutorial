<div class="container-fluid">
	<div class="side-body">

		<div class="row">
			<div class="col-xs-12">
				<div class="card">
					<div class="card-header">
						<div class="card-title">
							<div class="title"><?php echo $form_heading;?>   </div>
						</div>
                        <div class="pull-right card-action">
                            <div class="btn-group" role="group" aria-label="...">
                                <a  href="<?php echo admin_url().$module;?>" class="btn btn-info">Back</a>
                            </div>
                        </div>
                        
                        
					</div>

					<div class="card-body">
					<ul class=" alert_msg  alert-danger  alert container_alert" style="display: none;">
					
					</ul>	          
                <?php echo form_open_multipart(admin_url().$module."/$module_action",' class="form-horizontal" id="common_form" ' );?>
                         <div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('clinet_name').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('client_name',stripslashes($records['client_name']),' class="form-control required"  ');?></div></div>
						</div>

						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('client_username').get_required();?></label>
                            <div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('client_username',stripslashes($records['client_username']),' class="form-control required  " disabled ');?></div></div>
						</div>
						
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('client_email').get_required();?></label>
                            <div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_input('client_email',stripslashes($records['client_email_address']),' class="form-control required email"  ');?></div></div>
						</div>

						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('clinet_logo');?></label>
                            <div class="col-sm-<?php echo get_form_size();?>">
                                <div class="input_box">
                                    <div class="custom_browsefile">
                                        <?php  echo form_upload('clinet_logo')?>
                                        <span class="result_browsefile"><span class="brows"></span>+ Upload Logo</span>
                                    </div>
                                    
                                </div>
                                
                            </div>
                              <div class="col-xs-6 col-md-3 show_image_box">
							<a class="thumbnail"    href="javascript:;" title="<?php echo get_label('remove_image_title');?>">
							<img class="img-responsive common_delete_image" style="width: 250px; height:250px;"  src="<?php echo media_url().$records['client_folder_name']."/". get_label('compnay_folder_name')."/".$records['client_logo'];?>">
							</a>
							</div>
						</div>

						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('clinet_info');?></label>
                            <div class="col-sm-<?php echo get_form_size();?>"><div class="input_box"><?php  echo form_textarea('client_info',stripslashes($records['client_about_company']),'class="form-control" ' )?></div></div>
						</div>

						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label"><?php echo get_label('clinet_cate').get_required();?></label>
							<div class="col-sm-<?php echo get_form_size();?>"> <div class="input_box">
							 <?php echo get_client_category('',$records['client_category'],' class="form-control required" id="client_cate" ');?>
                                </div>
							</div>
						</div>
                        
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-<?php echo get_form_size();?>  btn_submit_div">
                                <button type="submit" class="btn btn-primary " name="submit"
                                    value="Submit"><?php echo get_label('submit');?></button>
                                <a class="btn btn-info" href="<?php echo admin_url().$module;?>"><?php echo get_label('cancel');?></a>
                            </div>
                        </div>
					</div>

					<?php
					echo form_hidden('edit_id',$records['client_id']);
					echo form_hidden('remove_image','No');
					echo form_hidden ( 'action', 'edit' );
					echo form_close ();
					?>
			
				</div>
			</div>
		</div>
	</div>
</div>
