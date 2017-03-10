<?php echo $this->load->view('layout/left-menu'); ?>
<h1>Add Email</h1>
<div class="col-xs-offset-2 col-xs-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="text-center">Add Email</h3>
        </div>
        <div class="panel-body">
        
            <form name="sms_form" id="sms_form" method="post" action="<?php echo frontend_url() . 'emailsetting/insert'; ?>" data-parsley-validate="">
                <div class="form-group">
                    <label >Name <span style="color:red">*</span></label>
                    <input type="text" name="email_name" id="email_name" tabindex="1" class="form-control" placeholder="Enter Name" value="" required="" data-parsley-minlength="3" maxlength="50">
                </div>	
                <div class="form-group">
                    <label >From Email <span style="color:red">*</span></label>
                    <input type="email" name="email_from" id="email_from" tabindex="1" class="form-control" placeholder="Enter From Email" value="" required="" data-parsley-minlength="3" maxlength="50">
                </div>
                <div class="form-group">
                    <label >to Email <span style="color:red">*</span></label>
                    <input type="email" name="email_to" id="email_to" tabindex="1" class="form-control" placeholder="Enter To Email" value="" required="" data-parsley-minlength="3" maxlength="50">
                </div>
                
                <div class="form-group">
                    <label >Template <span style="color:red">*</span></label>
                    <?php echo get_editor(array('field_name' => 'email_template', 'field_value' => set_value('email_template'))); ?>
                </div>	
               	
                <div class="form-group">
                    <label >Template Variable <span style="color:red">*</span></label>
                    <input type="text" name="email_variable" id="email_variable" tabindex="1" class="form-control" placeholder="Enter Template Variable" value="" required="" data-parsley-minlength="3">
                </div>	
                <div class="form-group">
                    <label >Status <span style="color:red">*</span></label>
                    <select name="email_status" id="email_status" class="form-control" required="" >
                        <option value="">-Select Status-</option>
                        <option value="0">Pending</option>
                        <option value="1">Active</option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-sm-offset-3">
                            <input type="submit" name="email_status-submit" id="email_status-submit" tabindex="4" class="form-control btn btn-primary" value="Add">
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
<script>
$( document ).ready( function() {
	$( 'textarea#email_template' ).ckeditor();
});
</script>
