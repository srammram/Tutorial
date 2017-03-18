<?php echo $this->load->view('layout/left-menu'); ?>
<h1>Add Menus</h1>
<div class="col-xs-offset-2 col-xs-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="text-center">Add Menus</h3>
        </div>
        <div class="panel-body">
            <form name="menus_form" id="menus_form" method="post" action="<?php echo frontend_url() . 'menus/insert'; ?>" data-parsley-validate="">
                
                
                
                <div class="form-group">
                    <label >Name <span style="color:red">*</span></label>
                    <input type="text" name="menus" id="menus" tabindex="1" class="form-control" placeholder="Enter Menus Name" required="" data-parsley-minlength="3" maxlength="250">
                </div>
                <div class="form-group">
                    <label >Status <span style="color:red">*</span></label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="">-Select Status-</option>
                        <option value="0">Pending</option>
                        <option value="1">Active</option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-sm-offset-3">
                            <input type="submit" name="menus-submit" id="menus-submit" tabindex="4" class="form-control btn btn-primary" value="Add">
                        </div>
                        <div class="col-sm-3 ">
                            <input type="reset" name="menus-reset" id="menus-reset" tabindex="4" class="form-control btn btn-danger" value="Clear">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

