<?php echo $this->load->view('layout/left-menu'); ?>

<h1>Add Task</h1>
<div class="col-xs-offset-2 col-xs-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="text-center">Add Task</h3>
        </div>
        <div class="panel-body">
            <form name="add_new_task" id="add_new_task" method="post" action="<?php echo frontend_url() . 'tasks/insert_new_task'; ?>" data-parsley-validate="">

                <div class="form-group">
                    <label>Select Project <span style="color:red">*</span></label>
                    <select name="add_project" id="add_project" class="form-control" required="" onchange="getnewtask_details(this.value);">
                        <option value="">-Select Project-</option>
                        <?php foreach ($project_details as $details): ?>
                            <option value="<?php echo $details['projects_id']; ?>"><?php echo $details['project_name']; ?></option>
                        <?php endforeach; ?>
                        <option value="others">Others</option>
                    </select>
                </div>
                <input type="text" name="finisehd_hours" id="finished_hours" value=""/>
                <input type="text" name="estimated_hours" id="estimated_hours" value=""/>
                <div class="form-group">
                    <label>Select Task</label>
                    <select name="add_selected_task" id="add_selected_task" class="form-control" onchange="getfinished_hours(this.value);">
                        <option value="">-Select Task-</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Message <span style="color:red">*</span></label>
                    <textarea placeholder="Enter Message" name="add_message" id="add_message" class="form-control" rows="5" style="resize:none" required="" data-parsley-minlength="5" maxlength="1000"></textarea>
                </div>
                <div class="form-group">
                    <label>Start Date <span style="color:red">*</span></label>
                    <input type="text" required="" name="add_start_date" id="add_start_date" class="form-control" placeholder="Choose Start Date"/>
                </div>
                <div class="form-group">
                    <label>End Date <span style="color:red">*</span></label>
                    <input type="text" required="" name="add_end_date" id="add_end_date" class="form-control" placeholder="Choose End Date"/>
                </div>
                <div class="form-group">
                    <label>Enter Duration Hours <span style="color:red">*</span></label>
                    <input type="text" required="" name="add_duration_hours" id="add_duration_hours" class="form-control" placeholder="Choose Duration Hours"/>
                </div>
                <div class="form-group">
                    <label>Select Status <span style="color:red">*</span></label>
                    <select name="task_status" id="task_status" class="form-control" required="" onchange="checkstatus_withfinished(this.value)">
                        <option value="">-Select Status-</option>
                        <option value="3">In Progress</option>
                        <option value="4">In Completed</option>
                        <option value="5">Completed</option>
                    </select>
                </div>
                <div class="form-group" id="delay_reason_div" style="display:none">
                    <label>Enter Delay Reason </label>
                    <textarea placeholder="Enter Delay Reason" name="delay_reason" value="delay_reason" rows="5" style="resize:none" class="form-control"></textarea>
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
            </form>

        </div>
    </div>
</div>
</div>
<script type="text/javascript">



    $(function () {

        $('#add_start_date').datetimepicker({
            daysOfWeekDisabled: [0],
            minDate: moment(),
            useCurrent: false,
        });
        $('#add_end_date').datetimepicker({
            useCurrent: false,
        });
        $("#add_start_date").on("dp.change", function (e) {
            $('#add_end_date').data("DateTimePicker").minDate(e.date);
        });


    });
</script>