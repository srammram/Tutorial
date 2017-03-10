<?php echo $this->load->view('layout/left-menu'); ?>
<h1>Edit Sms</h1>
<div class="col-xs-offset-2 col-xs-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="text-center">Edit Sms</h3>
        </div>
        <div class="panel-body">
        
            <form name="sms_form" id="sms_form" method="post" action="<?php echo frontend_url() . 'smssetting/update'; ?>" data-parsley-validate="">
                	
                <div class="form-group">
                    <label >Template <span style="color:red">*</span></label>
                    <textarea class="form-control" name="sms_template" id="sms_template" placeholder="Enter Template"  required data-parsley-minlength="3"><?php echo stripslashes($records[0]['sms_content']); ?></textarea>
                </div>	
                <div class="form-group">
                    <label >Template Variable <span style="color:red">*</span></label>
                    <input type="text" name="sms_variable" id="sms_variable" tabindex="1" class="form-control" placeholder="Enter Template Variable" value="<?php echo stripslashes($records[0]['sms_variable']); ?>" required="" data-parsley-minlength="3">
                </div>	
               
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-sm-offset-3">
                        	<input type="hidden" name="sms_id" id="sms_id" value="<?php echo $records[0]['id']; ?>"/>
                            <input type="submit" name="sms_status-submit" id="sms_status-submit" tabindex="4" class="form-control btn btn-primary" value="Update">
                        </div>
                        <div class="col-sm-3 ">
                            <input type="reset" name="sms_status-reset" id="sms_status-reset" tabindex="4" class="form-control btn btn-danger" value="Clear">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
