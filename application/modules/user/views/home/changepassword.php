
<?php echo $this->load->view('layout/left-menu'); ?>


<div class="clear" style="clear: both;height:3em"></div>


<div class="col-xs-offset-2 col-xs-8">
	
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="text-center">Change Password</h3>
        </div>
        <div class="panel-body">
        	
            <form name="changepassword_form" id="changepassword_form" method="post" action="<?php echo frontend_url().'changepassword'; ?>" data-parsley-validate="">
            	
               <div class="form-group">
                    <label >Old Password <span style="color:red">*</span></label>
                    <input type="text" name="old_password" id="old_password" class="form-control" placeholder="Old Password" value="<?php echo set_value('old_password'); ?>" required="" >
                </div>
                
                <div class="form-group">
                    <label >New Password <span style="color:red">*</span></label>
                    <input type="text" name="new_password" id="new_password" class="form-control" placeholder="New Password" value="<?php echo set_value('new_password'); ?>" required="" >
                </div>
                
                <div class="form-group">
                    <label >Confirm Password <span style="color:red">*</span></label>
                    <input type="text" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" value="<?php echo set_value('confirm_password'); ?>" required="" >
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-sm-offset-3">
                            <input type="submit" name="changepassword-submit" id="changepassword-submit" class="form-control btn btn-primary" value="Submit">
                        </div>
                        <div class="col-sm-3 ">
                            <input type="reset" name="changepassword-reset" id="changepassword-reset" class="form-control btn btn-danger" value="Clear">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row">
    <!-- bar chart -->

</div>
<div class="clearfix"></div>
</div>