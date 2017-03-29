<?php echo $this->load->view('layout/left-menu'); ?>

<h1>Add Tasks</h1>
<div class="col-xs-offset-2 col-xs-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="text-center">Add Tasks</h3>
        </div>
        <div class="panel-body">
            <form name="task_form" id="task_form" data-parsley-validate="" method="post" action="<?php echo frontend_url() . 'tasks/insert'; ?>">
                <div class="form-group">
                    <label>Select Project <span style="color:red">*</span></label>
                    <select name="task_project" id="task_project" class="form-control" required onchange="get_tasks_employee(this.value)">
                        <option value="">-Select Project-</option>
                        <?php for ($i = 0; $i < count($project_id); $i++): ?>
                            <option value="<?php echo $project_id[$i]; ?>"><?php echo $project_title[$i]; ?></option>
                        <?php endfor; ?>
                        <option value="others">Others</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Select Task <span style="color:red">*</span></label>
                    <select name="task_title" id="task_title" class="form-control" required>
                        <option value="">-Select Task-</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Description <span style="color:red">*</span></label>
                    <textarea name="task_description" required="" data-parsley-minlength="5" id="task_description" class="form-control" rows="5" style="resize:none" placeholder="Enter Description"></textarea>
                </div>
                <div class="form-group">
                    <label>Start Date <span style="color:red">*</span></label>
                    <input type="text" name="task_start_date" required=""  id="task_start_date" class="task_start_date form-control"/>
                </div>
                <div class="form-group">
                    <label>End Date <span style="color:red">*</span></label>
                    <input type="text" name="task_end_date" required="" id="task_end_date" class="task_end_date form-control"/>
                </div>
                <div class="form-group">
                    <label>Duration Hours <span style="color:red">*</span></label>
                    <input type="text" name="task_duration" id="task_duration" required="" class="task_duration form-control" placeholder="25 Hours"/>
                </div>
                <div class="form-group">
                    <label>Status <span style="color:red">*</span></label>
                    <select name="task_status" id="task_status" class="form-control" required="">
                        <option value="">-Select Status-</option>
                        <option value="3">In Progress</option>
                        <option value="4">Completed</option>
                        <option value="5">Postponed</option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-sm-offset-3">
                            <input type="submit" name="task-submit" id="task-submit" tabindex="4" class="form-control btn btn-primary" value="Add">
                        </div>
                        <div class="col-sm-3 ">
                            <input type="reset" name="task-reset" id="task-reset" tabindex="4" class="form-control btn btn-danger" value="Clear">
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
</div>
</div>
<script type="text/javascript">
<?php
$currentdate = date('Y/m/d');
?>

    $('.task_start_date').datetimepicker({
        daysOfWeekDisabled: [0],
        minDate: moment(),
        useCurrent: false,
    });
    $('.task_end_date').datetimepicker({
        useCurrent: false,
        daysOfWeekDisabled: [0]
    });



</script>
