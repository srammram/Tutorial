
<form name="edit_new_task_form" id="edit_new_task_form" method="post" action="<?php echo frontend_url() . 'tasks/edit_new_task'; ?>" data-parsley-validate="" enctype="multipart/form-data">
    <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>View Task</h3>
    </div>
    <div class="modal-body">


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
                <div class="col-xs-4"><label>Estimated Hours</label></div>
                <div class="col-xs-1"><label>:</label></div>
                <div class="col-xs-6">
                    <label><?php echo $records[0]['assigned_hours']; ?></label>
                </div>
            </div>
        </div>
        <div class="clear" style="clear: both;height:1em"></div>
        <div class="form-group">
            <div class="col-xs-12">
                <?php
                if ($records[0]['status'] == 1):
                    $labelclass = "label label-primary";
                    $status = "Active";
                elseif ($records[0]['status'] == 3):
                    $labelclass = "label label-warning";
                    $status = "In Progress";
                elseif ($records[0]['status'] == 4):
                    $labelclass = "label label-success";
                    $status = "In Completed";
                elseif ($records[0]['status'] == 5):
                    if ($records[0]['assigned_hours'] > $records[0]['finished_hours']):
                        $labelclass = "label label-success";
                        $status = "In Time Completed";
                    elseif ($records[0]['assigned_hours'] == $records[0]['finished_hours']):
                        $labelclass = "label label-primary";
                        $status = "On Time Completed";
                    elseif ($records[0]['assigned_hours'] < $records[0]['finished_hours']):
                        $labelclass = "label label-danger";
                        $status = "Delay Completed";
                    endif;
                endif;
                ?>
                <div class="col-xs-4"><label>Status</label></div>
                <div class="col-xs-1"><label>:</label></div>
                <div class="col-xs-6">
                    <label><?php echo $status; ?></label>
                </div>
            </div>
        </div>

        <?php if ($records[0]['status'] == 5): ?>
            <div class="clear" style="clear: both;height:1em"></div>
            <div class="form-group">
                <div class="col-xs-12">
                    <div class="col-xs-4"><label>Finished Hours</label></div>
                    <div class="col-xs-1"><label>:</label></div>
                    <div class="col-xs-6">
                        <label><?php echo $records[0]['finished_hours']; ?></label>
                    </div>
                </div>
            </div>
            <?php
            if ($status == 'In Time Completed'):
                ?>
                <div class="clear" style="clear: both;height:1em"></div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <div class="col-xs-4"><label>Saved Hours</label></div>
                        <div class="col-xs-1"><label>:</label></div>
                        <div class="col-xs-6">
                            <?php $savedhours = ($records[0]['assigned_hours'] - $records[0]['finished_hours']); ?>
                            <label><?php echo number_format($savedhours, 2); ?></label>
                        </div>
                    </div>
                </div>
                <?php
            elseif ($status == 'Delay Completed'):
                ?>
                <div class="clear" style="clear: both;height:1em"></div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <div class="col-xs-4"><label>Delay Hours</label></div>
                        <div class="col-xs-1"><label>:</label></div>
                        <div class="col-xs-6">
                            <?php $savedhours = ($records[0]['finished_hours'] - $records[0]['assigned_hours']); ?>
                            <label><?php echo number_format($savedhours, 2); ?></label>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        <?php
        if ($records[0]['task_file'] != ''):
            ?>
            <div class="clear" style="clear: both;height:1em"></div>
            <div class="form-group">
                <label>Files</label>
                <br>
                <?php
                $mediafiles = explode('|*|', $records[0]['task_file']);
                ?>
                <?php
                $i = 1;
                foreach ($mediafiles as $media):
                    ?>


                    <a href="<?php echo frontend_url() . 'tasks/download_files/' . $media; ?>" style="font-size:20px" class="btn btn-success" >Download File <?php echo $i; ?></a>
                    <br/>   
                    <br/>   
                    <?php
                    $i++;
                endforeach;
                ?>
            </div>
        <?php endif; ?>
        <div class="clear" style="clear: both;height:1em"></div>
        <div class="form-group">
            <input type="button" name="task_close" id="task_close" class="btn btn-danger" value="Close" style="float:right" data-dismiss="modal" aria-hidden="true"/>
        </div>
        <div class="clear" style="clear: both;height:2em"></div>
    </div>

</form>
<script type="text/javascript">


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



</script>
