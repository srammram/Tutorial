<div class="form-group">
    <label>Select Employee <span style="color:red">*</span></label>
    <select name="asign_user_details" id="asign_user_details" class="form-control" required="">
        <option value="">-Select Employee</option>
        <?php
        foreach ($records as $details):
            ?>
            <option value="<?php echo $details['id'] ?>"><?php echo $details['user_name']; ?></option>
        <?php endforeach; ?>
    </select>
</div>
<script type="text/javascript">
    $(function () {
        return $('#asign_user_details').select2(
                /*{
                 minimumResultsForSearch: Infinity
                 }*/
                );
    });
</script>
