<?php echo $this->load->view('layout/left-menu'); ?>
<h1>Edit Email</h1>
<div class="col-xs-offset-2 col-xs-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="text-center">Edit Email</h3>
        </div>
        <div class="panel-body">
        
            <form name="email_form" id="email_form" method="post" action="<?php echo frontend_url() . 'smssetting/update'; ?>" data-parsley-validate="">
                	
                	
                <div class="form-group">
                    <label >Template <span style="color:red">*</span></label>
                    <?php echo get_editor(array('field_name' => 'email_template', 'field_value' => $records[0]['email_content'])); ?>
                </div>	
                
                <div class="form-group">
                    <label >Template Variable <span style="color:red">*</span></label>
                    <input type="text" name="email_variable" id="email_variable" tabindex="1" class="form-control" placeholder="Enter Template Variable" value="<?php echo stripslashes($records[0]['email_variables']); ?>" required="" data-parsley-minlength="3">
                </div>	
               
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-sm-offset-3">
                        	<input type="hidden" name="email_id" id="sms_id" value="<?php echo $records[0]['id']; ?>"/>
                            <input type="submit" name="email_status-submit" id="email_status-submit" tabindex="4" class="form-control btn btn-primary" value="Update">
                        </div>
                        <div class="col-sm-3 ">
                            <input type="reset" name="email_status-reset" id="email_status-reset" tabindex="4" class="form-control btn btn-danger" value="Clear">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
