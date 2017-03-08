<?php echo $this->load->view('layout/left-menu'); ?>
<h1>Add Sms</h1>
<div class="col-xs-offset-2 col-xs-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="text-center">Add Sms</h3>
        </div>
        <div class="panel-body">
        
            <form name="sms_form" id="sms_form" method="post" action="<?php echo frontend_url() . 'smssetting/insert'; ?>" data-parsley-validate="">
                <div class="form-group">
                    <label >Name <span style="color:red">*</span></label>
                    <input type="text" name="sms_name" id="sms_name" tabindex="1" class="form-control" placeholder="Enter Name" value="<?php echo set_value('sms_name'); ?>" required="" data-parsley-minlength="3" maxlength="50">
                </div>	
                <div class="form-group">
                    <label >Template <span style="color:red">*</span></label>
                    <textarea class="form-control" name="sms_template" id="sms_template" placeholder="Enter Template" value="<?php echo set_value('sms_name'); ?>" required="" data-parsley-minlength="3"></textarea>
                </div>	
                <div class="form-group">
                    <label >Template Variable <span style="color:red">*</span></label>
                    <input type="text" name="sms_variable" id="sms_variable" tabindex="1" class="form-control" placeholder="Enter Template Variable" value="<?php echo set_value('sms_name'); ?>" required="" data-parsley-minlength="3">
                </div>	
                <div class="form-group">
                    <label >Status <span style="color:red">*</span></label>
                    <select name="sms_status" id="sms_status" class="form-control" >
                        <option value="">-Select Status-</option>
                        <option value="0">Pending</option>
                        <option value="1">Active</option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-sm-offset-3">
                            <input type="submit" name="sms_status-submit" id="sms_status-submit" tabindex="4" class="form-control btn btn-primary" value="Add">
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
