<?php echo $this->load->view('layout/left-menu'); ?>
<h1>Add Holiday</h1>
<div class="col-xs-offset-2 col-xs-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="text-center">Add Holiday</h3>
        </div>
        <div class="panel-body">
            <form name="holidays_form" id="holidays_form" method="post" action="<?php echo frontend_url() . 'holidays/insert'; ?>" data-parsley-validate="">
                
                <div class="form-group">
                    <label >Holiday Date<span style="color:red">*</span></label>
                    <input type="text" name="holiday_date" id="holiday_date" tabindex="1" class="form-control" placeholder="choose your holiday date" required="" >
                </div>
                
                <div class="form-group">
                    <label >Holiday reason <span style="color:red">*</span></label>
                    <input type="text" name="holiday_reason" id="holiday_reason" tabindex="1" class="form-control" placeholder="Enter holiday reason" required="" data-parsley-minlength="3" maxlength="250">
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
                            <input type="submit" name="holidays-submit" id="usertype-submit" tabindex="4" class="form-control btn btn-primary" value="Add">
                        </div>
                        <div class="col-sm-3 ">
                            <input type="reset" name="holidays-reset" id="usertype-reset" tabindex="4" class="form-control btn btn-danger" value="Clear">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    $('#holiday_date').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
    });
</script>
