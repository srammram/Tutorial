
<?php echo $this->load->view('layout/left-menu'); ?>


<div class="clear" style="clear: both;height:3em"></div>

<?php

if(isset($_SESSION['mobile'])){
?>
<?php
$mobile = $_SESSION['mobile'];
?>
<div class="col-xs-offset-2 col-xs-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="text-center">Type Your OTP</h3>
        </div>
        <div class="panel-body">
            <form name="otp_form" id="otp_form" method="post" action="<?php echo frontend_url() . 'mobilechange'; ?>" data-parsley-validate="">
            	
                <div class="form-group">
                    <label >OTP <span style="color:red">*</span></label>
                    <input type="text" name="otp" id="otp" class="form-control" placeholder="OTP" value="" required="" data-parsley-type="integer" maxlength="6" >
                </div>
                
                
                    	<input type="hidden" name="user_mobile" id="user_mobile" value="<?php echo get_session_value('user_mobile') ?>">
                        <div class="col-sm-3 col-sm-offset-1">
                            <input type="submit" name="mobilechange-otp" id="mobilechange-otp" tabindex="4" class="form-control btn btn-primary" value="Submit OTP">
                        </div>
                        
                        <div class="col-sm-3 ">
                            <input type="reset" name="mobilechange-reset" id="mobilechange-reset" tabindex="4" class="form-control btn btn-danger" value="Clear">
                        </div>
                   
            </form>
            
            <form name="resend_form" id="resend_form" method="post" action="<?php echo frontend_url() . 'mobilechange'; ?>" data-parsley-validate="">
                <input type="hidden" name="user_mobile" id="user_mobile" value="<?php echo get_session_value('user_mobile') ?>">
                <input type="hidden" name="resend_mobile" id="resend_mobile" value="<?php echo $mobile;  ?>">
                <div class="col-sm-3 pull-left col-sm-offset-7" style="margin-top:-40px;">
                    <input type="submit" name="mobilechange-resend" id="mobilechange-resend" tabindex="4" class="form-control btn btn-warning" value="Resend OTP">
                </div>
            </form>
            
        </div>
    </div>
</div>

<?php
}else{
?>

<div class="col-xs-offset-2 col-xs-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="text-center">Change Mobile Number</h3>
        </div>
        <div class="panel-body">
            <form name="mobilechange_form" id="mobilechange_form" method="post" action="<?php echo frontend_url() . 'mobilechange'; ?>" data-parsley-validate="">
                <div class="form-group">
                    <label >Old Mobile <span style="color:red">*</span></label>
                    <input type="text" name="old_mobile" id="old_mobile" class="form-control" placeholder="Old Mobile" value="" required="" data-parsley-type="integer" maxlength="10" >
                </div>
                
                <div class="form-group">
                    <label >New Mobile <span style="color:red">*</span></label>
                    <input type="text" name="new_mobile" id="new_mobile" class="form-control" placeholder="New Mobile" value="" required="" data-parsley-type="integer"  maxlength="10">
                </div>
                
                <div class="form-group">
                    <label >Confirm Mobile <span style="color:red">*</span></label>
                    <input type="text" name="confirm_mobile" id="confirm_mobile" class="form-control" placeholder="Confirm Mobile" value="" required="" data-parsley-type="integer" maxlength="10" >
                </div>
               
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-sm-offset-3">
                            <input type="submit" name="mobilechange-submit" id="mobilechange-submit" tabindex="4" class="form-control btn btn-primary" value="Submit">
                        </div>
                        <div class="col-sm-3 ">
                            <input type="reset" name="mobilechange-reset" id="mobilechange-reset" tabindex="4" class="form-control btn btn-danger" value="Clear">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
}
?>

<?php
unset($_SESSION['mobile']);
?>
<div class="row">
    <!-- bar chart -->

</div>
<div class="clearfix"></div>
</div>