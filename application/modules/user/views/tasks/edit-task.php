<form name="editask_form" id="editask_form" method="post" action="<?php echo frontend_url() . 'tasks/update'; ?>" data-parsley-validate="" enctype="multipart/form-data">
    <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <?php if ($task_details[0]['status'] != 4 && $_SESSION['user_type_id'] != 6): ?>
            <h4 class="modal-title">Edit Task</h4>
        <?php else: ?>
            <h4 class="modal-title">View Task</h4>
        <?php endif; ?>
        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $edit_id; ?>"/>
    </div>
    <div class="modal-body" >
        <div class="form-group">
            <label>Select Project <span style="color:red">*</span></label>
            <select <?php
            if ($_SESSION['user_type_id'] == 6 || $task_details[0]['status'] == 4): echo "readonly";
            endif;
            ?> name="task_project" id="task_project" class="form-control" required>
                <option value="">-Select Project-</option>
                <?php foreach ($project_details as $details): ?>
                    <option value="<?php echo $details['projects_id'] ?>" <?php
                    if ($details['projects_id'] == $task_details[0]['projects_id']): echo "selected";
                    endif;
                    ?>><?php echo $details['project_name']; ?></option>
                        <?php endforeach; ?>
            </select>
        </div>
        <?php if ($task_details[0]['task_type'] == 1 && $_SESSION['user_type_id'] != 6): ?>
            <div class="form-group">
                <label>Select Employee <span style="color:red">*</span></label>
                <select <?php
                if ($_SESSION['user_type_id'] == 6 || $task_details[0]['status'] == 4): echo "readonly";
                endif;
                ?> name="task_employee" id="task_employee" class="form-control" required>
                    <option value="">-Select Employee-</option>
                    <?php
                    foreach ($employee_details as $empdet):
                        ?>
                        <option value="<?php echo $empdet['id'] ?>" <?php
                        if ($empdet['id'] == $task_details[0]['to_user_id']): echo "selected";
                        endif;
                        ?>><?php echo $empdet['user_name']; ?></option>
                            <?php endforeach; ?>
                </select>
            </div>
        <?php endif; ?>
        <div class="form-group">
            <label>Description <span style="color:red">*</span></label>
            <textarea  <?php
            if ($_SESSION['user_type_id'] == 6 || $task_details[0]['status'] == 4): echo "readonly";
            endif;
            ?> name="task_description" required="" data-parsley-minlength="5" id="task_description" class="form-control" rows="5" style="resize:none" placeholder="Enter Description"><?php echo (($task_details[0]['message'])); ?></textarea>
        </div>
        <div class="form-group">
            <label>Start Date <span style="color:red">*</span></label>
            <input type="text" <?php
            if ($_SESSION['user_type_id'] == 6 || $task_details[0]['status'] == 4): echo "readonly";
            endif;
            ?> name="task_start_date" required=""  id="task_start_date" class="task_start_date form-control" value="<?php echo date('m/d/Y h:i a', strtotime($task_details[0]['assigned_datetime'])); ?>"/>
        </div>
        <div class="form-group">
            <label>End Date <span style="color:red">*</span></label>
            <input  <?php
            if ($_SESSION['user_type_id'] == 6 || $task_details[0]['status'] == 4): echo "readonly";
            endif;
            ?>  type="text" name="task_end_date" required="" id="task_end_date" class="task_end_date form-control" value="<?php echo date('m/d/Y h:i a', strtotime($task_details[0]['finished_datetime'])); ?>" />
        </div>

        <div class="form-group">
            <label>Duration Hours <span style="color:red">*</span></label>
            <input type="text" <?php
            if ($_SESSION['user_type_id'] == 6 || $task_details[0]['status'] == 4): echo "readonly";
            endif;
            ?> name="task_duration" id="task_duration" required="" class="task_duration form-control" value="<?php echo $task_details[0]['project_duration']; ?>"/>
        </div>
        <?php if ($task_details[0]['status'] != 4 && $_SESSION['user_type_id'] != 6): ?>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-3 col-sm-offset-3">
                        <input type="submit" name="task-submit" id="task-submit" tabindex="4" class="form-control btn btn-primary" value="Update">
                    </div>
                    <div class="col-sm-3 ">
                        <input type="reset" name="task-reset" id="task-reset" tabindex="4" class="form-control btn btn-danger" value="Clear">
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</form>

<script type="text/javascript">

    $('.task_start_date').datetimepicker({
        daysOfWeekDisabled: [0]
    });
    $('.task_end_date').datetimepicker({
        useCurrent: false,
        daysOfWeekDisabled: [0]
    });
<?php if ($_SESSION['user_type_id'] == 6): ?>
        $('.task_finished_date').datetimepicker({
            useCurrent: false,
            daysOfWeekDisabled: [0],
            minDate: moment()
        });
<?php endif; ?>
    $("#task_start_date").on("dp.change", function (e) {
        $('#task_end_date').data("DateTimePicker").minDate(e.date);
    });
    $("#task_end_date").on("dp.change", function (e) {
        $('#task_start_date').data("DateTimePicker").maxDate(e.date);
        var task_start_date = $('#task_start_date').val();
        var task_end_date = $('#task_end_date').val();
        $.ajax({
            url: FRONTEND_URL + 'tasks/calculate_hours',
            data: {task_start_date: task_start_date, task_end_date: task_end_date},
            dataType: 'json',
            type: 'post',
            success: function (output) {
                $('#task_duration').val(output.message);
            }
        })
    });


</script>