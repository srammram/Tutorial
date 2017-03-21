
<form name="edit_note" id="edit_note" method="post" data-parsley-validate="">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Edit Note</h4>
    </div>

    <div class="modal-body" >
        <div class="col-xs-12" id="err_message">

        </div>
        <div class="form-group">
            <label >Notes <span style="color:red">*</span></label>
            <textarea name="message" id="notemessage" rows="5" class="form-control" placeholder="Note (Maximum 250 charater only)" data-parsley-minlength="15" maxlength="250" required=""><?php echo $message; ?></textarea>
            
        </div>
        
        <div class="form-group">
            <label >Color <span style="color:red">*</span></label>
            <div class="clearfix"></div>
            <div class="col-xs-4">
                <input type="radio" name="color"  class="color" <?php if($color=='#FDFB8C'){ ?> checked <?php } ?> value="#FDFB8C">
                <div style="width:100%; min-height:100px; background:#FDFB8C; margin-bottom:15px;"></div>
            </div>
            <div class="col-xs-4">
                <input type="radio" name="color" class="color" <?php if($color=='#A6E3FC'){ ?> checked <?php } ?> value="#A6E3FC">
                <div style="width:100%; min-height:100px; background:#A6E3FC; margin-bottom:15px;"></div>
            </div>
            <div class="col-xs-4">
                <input type="radio" name="color" class="color" <?php if($color=='#A5F88B'){ ?> checked <?php } ?> value="#A5F88B">
                <div style="width:100%; min-height:100px; background:#A5F88B; margin-bottom:15px;"></div>
            </div>
            
        </div>
        
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="validatenote">Update</button>
    </div>
</form>

<script type="text/javascript">
    var $form = $('#edit_note');
    $('#validatenote').click(function () {
        if ($form.parsley().validate()) {
            updatenote(<?php echo $edit_id; ?>);
        }
    });
</script>

