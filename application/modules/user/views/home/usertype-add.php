<?php echo $this->load->view('layout/left-menu'); ?>
<h1>Add User Type</h1>
<div class="col-xs-offset-2 col-xs-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="text-center">Add User Type</h3>
        </div>
        <div class="panel-body">
            <form name="usertype_form" id="usertype_form" method="post" action="<?php echo frontend_url() . 'usertype/insert'; ?>" data-parsley-validate="">
                <div class="form-group">
                    <label >Name <span style="color:red">*</span></label>
                    <input type="text" name="use_type_name" id="use_type_name" tabindex="1" class="form-control" placeholder="Enter Name" value="<?php echo set_value('use_type_name'); ?>" required="" data-parsley-minlength="3" maxlength="50">
                </div>
                <div class="form-group">
                    <label >Status <span style="color:red">*</span></label>
                    <select name="type_status" id="type_status" class="form-control" required="">
                        <option value="">-Select Status-</option>
                        <option value="0">Pending</option>
                        <option value="1">Active</option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-sm-offset-3">
                            <input type="submit" name="usertype-submit" id="usertype-submit" tabindex="4" class="form-control btn btn-primary" value="Add">
                        </div>
                        <div class="col-sm-3 ">
                            <input type="reset" name="usertype-reset" id="usertype-reset" tabindex="4" class="form-control btn btn-danger" value="Clear">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
