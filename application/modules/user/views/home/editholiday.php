
<form name="edit_holiday" id="edit_holiday" method="post" data-parsley-validate="">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Edit Department</h4>
    </div>

    <div class="modal-body" >
        <div class="col-xs-12" id="err_message">

        </div>
        <div class="form-group">
            <label >Holiday Date<span style="color:red">*</span></label>
            <input type="text" name="holiday_date" id="holiday_date" tabindex="1" class="form-control" placeholder="choose your holiday date" required="" value="<?php echo $holiday_date; ?>" >
        </div>
        
        <div class="form-group">
            <label >Holiday reason <span style="color:red">*</span></label>
            <input type="text" name="holiday_reason" id="holiday_reason" tabindex="1" class="form-control" placeholder="Enter holiday reason" required="" value="<?php echo $holiday_reason; ?>" data-parsley-minlength="3" maxlength="250">
        </div>
        
        
        <div class="form-group">
            <label >Status <span style="color:red">*</span></label>
            <select name="edit_status" id="edit_status" class="form-control" required>
                <option value="">-Select Status-</option>
                <option value="0" <?php
                if ($status == 0): echo "selected";
                endif;
                ?>>Pending</option>
                <option value="1" <?php
                if ($status == 1): echo "selected";
                endif;
                ?>>Active</option>
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="validateholiday">Update</button>
    </div>
</form>
<script type="text/javascript">
    $('#holiday_date').datepicker({
        dateFormat: 'yy-mm-dd',
        autoclose: true,
    });
</script>
<script type="text/javascript">
    var $form = $('#edit_holiday');
    $('#validateholiday').click(function () {
        if ($form.parsley().validate()) {
            updateholiday(<?php echo $edit_id; ?>);
        }
    });
</script>

