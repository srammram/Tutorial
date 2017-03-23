<?php echo $this->load->view('layout/left-menu'); ?>
<h1>Add Remainder</h1>
<div class="col-xs-offset-2 col-xs-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="text-center">Add Remainder</h3>
        </div>
        <div class="panel-body">
            <form name="remainder_form" id="remainder_form" method="post" action="<?php echo frontend_url() . 'remainder/insert'; ?>" data-parsley-validate="">
                
                <div class="form-group">
                    <label >Title <span style="color:red">*</span></label>
                    <input type="text" name="title" id="title" tabindex="1" class="form-control" placeholder="Enter Title" required="" data-parsley-minlength="3" maxlength="250">
                </div>
                
                
                
                <div class="form-group">
                    <label >Remain Date<span style="color:red">*</span></label>
                    <input type="text" name="remain_date" id="remain_date" tabindex="1" class="form-control" placeholder="choose your remain date" required="" >
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
                            <input type="submit" name="remainder-submit" id="remainder-submit" tabindex="4" class="form-control btn btn-primary" value="Add">
                        </div>
                        <div class="col-sm-3 ">
                            <input type="reset" name="remainder-reset" id="remainder-reset" tabindex="4" class="form-control btn btn-danger" value="Clear">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    $('#remain_date').datepicker({
        dateFormat: 'yy-mm-dd',
        autoclose: true,
    });
</script>
