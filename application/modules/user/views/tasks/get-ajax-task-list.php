<div class="form-group">
    <label>Select Task <span style="color:red">*</span></label>
    <select required="" name="select_task" id="select_task" class="form-control" data-parsley-error-container="select2">
        <option value="">-Select Task-</option>
        <?php
        foreach ($task_details as $details):
            ?>
            <option value="<?php echo $details['id'] ?>"><?php echo $details['task_title']; ?></option>
        <?php endforeach; ?>
    </select>
</div>
<div class="form-group">
    <label>Select Department <span style="color:red">*</span></label>
    <div class="clear" style="clear: both;height:0.1em"></div>
    <div class="col-xs-9">
        <select required="" name="select_department[]" id="select_department" class="form-control" multiple="" >
            <option value="" disabled>-Select Department-</option>
            <?php
            foreach ($department_details as $details):
                ?>
                <option value="<?php echo $details['id'] ?>"><?php echo $details['name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-xs-3">
        <input type="button" name="add_datetime" id="add_datetime" class="btn btn-success" value="Add End Datetime" onclick="add_dependency_datetime()"/>
    </div>
</div>
<div id="enddatetime_div">

</div>
<input type="hidden" name="departments_id" id="departemtns_id"/>
<div class="clear" style="clear: both;height:2em"></div>
<script type="text/javascript">

    $('#select_task,#select_department').select2();

    $("select[name^=select_department]").change(function () {
        var d = $(this).val();
        $('#departemtns_id').val(d);
    });

    function add_dependency_datetime() {
        var departemtns_id = $('#departemtns_id').val();
        $.ajax({
            url: FRONTEND_URL + 'tasks/selectend_datetime',
            data: {departemtns_id: departemtns_id},
            dataType: 'html',
            type: 'post',
            success: function (output) {
                $('#enddatetime_div').html(output);
            }

        });
    }
</script>