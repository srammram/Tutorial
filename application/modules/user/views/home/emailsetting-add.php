<?php echo $this->load->view('layout/left-menu'); ?>
<h1>Add Department</h1>
<div class="col-xs-offset-2 col-xs-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="text-center">Add Department</h3>
        </div>
        <div class="panel-body">
            <form name="department_form" id="department_form" method="post" action="<?php echo frontend_url() . 'departments/insert'; ?>" data-parsley-validate="">
                <div class="form-group">
                    <label >Name <span style="color:red">*</span></label>
                    <input type="text" name="department_name" id="department_name" tabindex="1" class="form-control" placeholder="Enter Name" value="<?php echo set_value('department_name'); ?>" required="" data-parsley-minlength="3" maxlength="50">
                </div>
                <div class="form-group">
                    <label >Status <span style="color:red">*</span></label>
                    <select name="department_status" id="department_status" class="form-control" >
                        <option value="">-Select Status-</option>
                        <option value="0">Pending</option>
                        <option value="1">Active</option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-sm-offset-3">
                            <input type="submit" name="department_status-submit" id="department_status-submit" tabindex="4" class="form-control btn btn-primary" value="Add">
                        </div>
                        <div class="col-sm-3 ">
                            <input type="reset" name="department_status-reset" id="department_status-reset" tabindex="4" class="form-control btn btn-danger" value="Clear">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
