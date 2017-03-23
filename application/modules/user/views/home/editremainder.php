
<form name="edit_remainder" id="edit_remainder" method="post" data-parsley-validate="">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Edit Remainder</h4>
    </div>

    <div class="modal-body" >
        <div class="col-xs-12" id="err_message">

        </div>
        
        <div class="form-group">
            <label >Title <span style="color:red">*</span></label>
            <input type="text" name="title" id="title" tabindex="1" class="form-control" placeholder="Enter Title" required="" value="<?php echo $holiday_reason; ?>" data-parsley-minlength="3" maxlength="250">
        </div>
        
        
        
        <div class="form-group">
            <label >Remainder Date<span style="color:red">*</span></label>
            <input type="text" name="remain_date" id="remain_date" tabindex="1" class="form-control" placeholder="choose your remain date" required="" value="<?php echo $remain_date; ?>" >
        </div>
        
        
      
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="validateremainder">Update</button>
    </div>
</form>
<script type="text/javascript">
    $('#remain_date').datepicker({
        format: 'yyyy-mm-dd H:i:s',
        autoclose: true,
    });
</script>
<script type="text/javascript">
    var $form = $('#edit_remainder');
    $('#validateremainder').click(function () {
        if ($form.parsley().validate()) {
            updateremainder(<?php echo $edit_id; ?>);
        }
    });
</script>

