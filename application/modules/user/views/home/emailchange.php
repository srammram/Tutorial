
<?php echo $this->load->view('layout/left-menu'); ?>


<div class="clear" style="clear: both;height:3em"></div>

<div class="col-xs-offset-2 col-xs-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="text-center">Change Email Address</h3>
        </div>
        <div class="panel-body">
            <form name="emailchange_form" id="emailchange_form" method="post" action="<?php echo frontend_url() . 'emailchange'; ?>" data-parsley-validate="">
                <div class="form-group">
                    <label >Old Email Address <span style="color:red">*</span></label>
                    <input type="text" name="old_email" id="old_email" class="form-control" placeholder="Old Email" value="" required="" data-parsley-type="email" >
                </div>
                
                <div class="form-group">
                    <label >New Email Address <span style="color:red">*</span></label>
                    <input type="text" name="new_email" id="new_email" class="form-control" placeholder="New Email" value="" required="" data-parsley-type="email" >
                </div>
                
                <div class="form-group">
                    <label >Confirm Email Address <span style="color:red">*</span></label>
                    <input type="text" name="comfirm_email" id="comfirm_email" class="form-control" placeholder="Confirm Email" value="" required="" data-parsley-type="email" >
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-sm-offset-3">
                            <input type="submit" name="emailchange-submit" id="emailchange-submit" tabindex="4" class="form-control btn btn-primary" value="Submit">
                        </div>
                        <div class="col-sm-3 ">
                            <input type="reset" name="emailchange-reset" id="emailchange-reset" tabindex="4" class="form-control btn btn-danger" value="Clear">
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