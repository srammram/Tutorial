<?php echo $this->load->view('layout/left-menu'); ?>

<h1>Add Tasks</h1>
<div class="col-xs-offset-2 col-xs-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="text-center">Add Tasks</h3>
        </div>
        <div class="panel-body">
            <form name="task_form" id="task_form" data-parsley-validate="" method="post" action="<?php echo frontend_url() . 'tasks/task_insert'; ?>">
                <input type="hidden" name="task_type" id="task_type" value="2"/>
                <div class="form-group">
                    <label>Select Project <span style="color:red">*</span></label>
                    <select name="task_project" id="task_project" class="form-control" required>
                        <option value="">-Select Project-</option>
                        <?php foreach ($project_details as $details): ?>
                            <option value="<?php echo $details['projects_id'] ?>"><?php echo $details['project_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Task Title</label>
                    <input type="text" name="task_title" id="task_title" class="form-control" placeholder="Enter Task Title" required="" data-parsley-minlength="5"/>
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
