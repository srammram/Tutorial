
<div class="form-group">

    <div class="col-xs-12">
        <div class="col-xs-4"><label>Project Name</label></div>
        <div class="col-xs-1"><label>:</label></div>
        <div class="col-xs-6">
            <label><?php echo $records[0]['project_name']; ?></label>
        </div>
    </div>
</div>
<div class="clear" style="clear:both;height:1em"></div>
<div class="form-group">
    <div class="col-xs-12">
        <div class="col-xs-4"><label>Project Description</label></div>
        <div class="col-xs-1"><label>:</label></div>
        <div class="col-xs-6">
            <label><?php echo $records[0]['description']; ?></label>
        </div>
    </div>
</div>
<div class="clear" style="clear:both;height:1em"></div>
<div class="form-group">
    <div class="col-xs-12">
        <div class="col-xs-4"><label>Assigned From</label></div>
        <div class="col-xs-1"><label>:</label></div>
        <div class="col-xs-6">
            <label><?php echo $records[0]['user_name']; ?></label>
        </div>
    </div>
</div>
<div class="clear" style="clear:both;height:1em"></div>
<div class="form-group">

    <div class="col-xs-12">
        <div class="col-xs-4"><label>Estimated Hours</label></div>
        <div class="col-xs-1"><label>:</label></div>
        <div class="col-xs-6">
            <label><?php echo $records[0]['assigned_hours'] . ' Hours'; ?></label>
        </div>
    </div>
</div>
<div class="clear" style="clear:both;height:1em"></div>
<div class="form-group">
    <div class="col-xs-12">
        <div class="col-xs-4"><label>Start Date</label></div>
        <div class="col-xs-1"><label>:</label></div>
        <div class="col-xs-6">
            <label><?php echo $records[0]['start_datetime'] != '' ? $records[0]['start_datetime'] : 'N/A'; ?></label>
        </div>
    </div>
</div>
<div class="clear" style="clear:both;height:1em"></div>
<div class="form-group">
    <div class="col-xs-12">
        <div class="col-xs-4"><label>End Date</label></div>
        <div class="col-xs-1"><label>:</label></div>
        <div class="col-xs-6">
            <label><?php echo $records[0]['end_datetime'] != '' ? $records[0]['end_datetime'] : 'N/A'; ?></label>
        </div>
    </div>
</div>
<?php
foreach ($usernames as $names):
    $user_names[] = $names['user_name'];
endforeach;
?>
<?php if ($record_id == 7): ?>
    <div class="clear" style="clear:both;height:1em"></div>
    <div class="form-group">
        <div class="col-xs-12">
            <div class="col-xs-4"><label>Assigned Members</label></div>
            <div class="col-xs-1"><label>:</label></div>
            <div class="col-xs-6">
                <label><?php echo count($user_names) != '0' ? implode(',', $user_names) : 'N/A'; ?></label>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="clear" style="clear:both;height:1em"></div>
<div class="form-group">
    <div class="col-xs-12">
        <div class="col-xs-4"><label>Used Hours</label></div>
        <div class="col-xs-1"><label>:</label></div>
        <div class="col-xs-6">
            <label>
                <?php if ($record_id == 7): ?>
                    <?php echo $used_hours = $used_hours; ?>
                <?php else: ?>
                    <?php echo $used_hours = $records[0]['finished_hours']; ?>
                <?php endif; ?>
            </label>
        </div>
    </div>
</div>
<div class="clear" style="clear:both;height:1em"></div>
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
<?php if ($records[0]['finished_message'] != ''): ?>
    <div class="clear" style="clear: both;height:1em"></div>
    <div class="form-group">
        <div class="col-xs-12">
            <div class="col-xs-4"><label>Delay Reason</label></div>
            <div class="col-xs-1"><label>:</label></div>
            <div class="col-xs-6">
                <label><?php echo $records[0]['finished_message']; ?></label>
            </div>
        </div>
    </div>
<?php endif; ?>
<div class="clear" style="clear: both;height:1em"></div>
<?php
if ($status == 'In Time Completed'):
    ?>
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
<?php elseif ($status == 'Delay Completed'): ?>
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
<div class="clear" style="clear: both;height:1em"></div>
<?php
$percentagehours = round(($used_hours * 100) / $records[0]['assigned_hours']);
?>
<a href="javascript:void(0)" class="btn btn-success" id="reminder_div" data-toggle="modal" data-target="#SampleModal" style="display: none">Add</a>
<div class="modal fade" id="AlertModal" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" area-hidden="true">&times;</button>
                <h4 class="modal-title">Projects</h4>
            </div>
            <div class="modal-body" id="getdashboard_details">
                <div class="form-group">
                    <h5>You are completed 75% time is assigned your projects. Do You Finished this  Project as per your scheduled.</h5>

                </div>
                <div class="form-group" id="reminderbut">
                    <input type="button" name="say_no" id="say_no" class="btn btn-danger" value="No" onclick="$('#reason_for_delay_hide').show();$('#reminderbut').hide();"/>
                    <input type="button" name="say_yes" id="say_yes" class="btn btn-success" value="Yes" onclick="$('#AlertModal').modal('hide');"/>
                </div>
                <div id="reason_for_delay_hide" style="display:none">
                    <div class="form-group" >
                        <label>Enter Reason</label>
                        <textarea name="delay_reason" id="delay_reason" class="form-control" rows="5" style="resize:none"></textarea>
                    </div>
                    <div class="form-group" >
                        <input type="button" name="say_ncancel" id="say_ncancel" class="btn btn-danger" value="Cancel" onclick="$('#reason_for_delay_hide').hide();$('#reminderbut').show();"/>
                        <input type="button" name="say_reason" id="say_reason" class="btn btn-success" value="Procced" onclick="delay_reason_by_project(<?php echo $project_id ?>,<?php echo $department_id; ?>)"/>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="border-top:0px">
                <button type="button" class="btn btn-default" onclick="modalhide('AlertModal')">Close</button>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">
<?php
if ($percentagehours > 75 && $maildetails[0]['id'] == '') {
    ?>
        $('#AlertModal').modal('show');
<?php } ?>
    function modalhide(modalname) {
        $('#' + modalname).modal('hide');
    }

</script>

