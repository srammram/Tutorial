
<form name="edit_menu" id="edit_menu" method="post" data-parsley-validate="">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Edit Menus</h4>
    </div>

    <div class="modal-body" >
        <div class="col-xs-12" id="err_message">

        </div>
        
        
        <div class="form-group">
            <label >Name <span style="color:red">*</span></label>
            <input type="text" name="menus" id="menus" tabindex="1" class="form-control" placeholder="Enter Name" required="" value="<?php echo $menus; ?>" data-parsley-minlength="3" maxlength="250">
        </div>
        <div class="form-group">
            <label >Link <span style="color:red">*</span></label>
            <input type="text" name="menulink" id="menulink" tabindex="1" class="form-control" placeholder="Enter Link" required="" value="<?php echo $menulink; ?>" data-parsley-minlength="3">
        </div>
        <div class="form-group">
            <label >Order <span style="color:red">*</span></label>
            <input type="text" name="menusort" id="menusort" tabindex="1" class="form-control" placeholder="Enter Order"  value="<?php echo $menusort; ?>" required="" data-parsley-type="number">
        </div>
        <div class="form-group">
            <label >Icon <span style="color:red">*</span></label>
            <input type="text" name="menuicon" id="menuicon" tabindex="1" class="form-control" placeholder="Enter Icon" required="" value="<?php echo $menuicon; ?>" >
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
        <button type="button" class="btn btn-primary" id="validatemenu">Update</button>
    </div>
</form>

<script type="text/javascript">
    var $form = $('#edit_menu');
    $('#validatemenu').click(function () {
        if ($form.parsley().validate()) {
            updatemenu(<?php echo $edit_id; ?>);
        }
    });
</script>

