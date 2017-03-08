
<form name="usertypeedit" id="usertypeedit" method="post" data-parsley-validate="">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Edit User Type</h4>
    </div>

    <div class="modal-body" >
        <div class="col-xs-12" id="err_message">

        </div>
        <div class="form-group">
            <label >Name <span style="color:red">*</span></label>
            <input type="text" name="edittype_name" id="edittype_name" tabindex="1" class="form-control" placeholder="Enter Name" value="<?php echo $typename; ?>" required="" data-parsley-minlength="3" maxlength="50">
        </div>
        <div class="form-group">
            <label >Status <span style="color:red">*</span></label>
            <select name="edit_type_status" id="edit_type_status" class="form-control" required="">
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
        <button type="button" class="btn btn-primary" id="validateusertype" >Update</button>
    </div>
</form>
<script type="text/javascript">
    var $form = $('#usertypeedit');
    $('#validateusertype').click(function () {
        if ($form.parsley().validate()) {
            updateusertype(<?php echo $edit_id; ?>);
        }

    });
</script>

