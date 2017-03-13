
<form name="edit_new_task_form" id="edit_new_task_form" method="post" action="<?php echo frontend_url() . 'tasks/edit_new_task'; ?>" data-parsley-validate="" enctype="multipart/form-data">
    <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>View Task</h3>
    </div>
    <div class="modal-body">
        <form name="add_new_task" id="add_new_task" method="post" action="<?php echo frontend_url() . 'tasks/insert_new_task'; ?>" data-parsley-validate="">

            <div class="form-group">
                <div class="col-xs-12">
                    <div class="col-xs-4"><label>Project Name</label></div>
                    <div class="col-xs-1"><label>:</label></div>
                    <div class="col-xs-6">
                        <?php if ($records[0]['project_name'] != ''): ?>
                            <label><?php echo $records[0]['project_name']; ?></label>
                        <?php else: ?>
                            <label><?php echo "Others"; ?></label>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="clear" style="clear: both;height:1em"></div>
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="col-xs-4"><label>Task Name</label></div>
                    <div class="col-xs-1"><label>:</label></div>
                    <div class="col-xs-6">
                        <label><?php echo $records[0]['task_title']; ?></label>
                    </div>
                </div>
            </div>
            <div class="clear" style="clear: both;height:1em"></div>
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="col-xs-4"><label>Description</label></div>
                    <div class="col-xs-1"><label>:</label></div>
                    <div class="col-xs-6">
                        <label><?php echo $records[0]['message']; ?></label>
                    </div>
                </div>
            </div>
            <div class="clear" style="clear: both;height:1em"></div>
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="col-xs-4"><label>Start Date</label></div>
                    <div class="col-xs-1"><label>:</label></div>
                    <div class="col-xs-6">
                        <label><?php echo $records[0]['start_datetime']; ?></label>
                    </div>
                </div>
            </div>
            <div class="clear" style="clear: both;height:1em"></div>
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="col-xs-4"><label>End Date</label></div>
                    <div class="col-xs-1"><label>:</label></div>
                    <div class="col-xs-6">
                        <label><?php echo $records[0]['end_datetime']; ?></label>
                    </div>
                </div>
            </div>
            <div class="clear" style="clear: both;height:1em"></div>
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="col-xs-4"><label>Duration Hours</label></div>
                    <div class="col-xs-1"><label>:</label></div>
                    <div class="col-xs-6">
                        <label><?php echo $records[0]['project_duration']; ?></label>
                    </div>
                </div>
            </div>
            <div class="clear" style="clear: both;height:1em"></div>
            <?php if ($records[0]['finished_status'] == 5): ?>
                <div class="form-group">
                    <div class="col-xs-12">
                        <div class="col-xs-4"><label>Finished hours</label></div>
                        <div class="col-xs-1"><label>:</label></div>
                        <div class="col-xs-6">
                            <label><?php echo $records[0]['finished_hours']; ?></label>
                        </div>
                    </div>
                </div>
                <div class="clear" style="clear: both;height:1em"></div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <div class="col-xs-4"><label>Message</label></div>
                        <div class="col-xs-1"><label>:</label></div>
                        <div class="col-xs-6">
                            <label><?php echo $records[0]['finished_message']; ?></label>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="clear" style="clear: both;height:2em"></div>
            <div class="form-group">
                <input type="button" name="task_close" id="task_close" class="btn btn-danger" value="Close" style="float:right" data-dismiss="modal" aria-hidden="true"/>
            </div>
            <div class="clear" style="clear: both;height:2em"></div>
    </div>

</form>
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
