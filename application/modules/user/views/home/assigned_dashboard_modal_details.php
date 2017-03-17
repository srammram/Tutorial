
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
        <div class="col-xs-4"><label>Assigned To</label></div>
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
            <label><?php echo $records[0]['start_datetime']; ?></label>
        </div>
    </div>
</div>
<div class="clear" style="clear:both;height:1em"></div>
<div class="form-group">
    <div class="col-xs-12">
        <div class="col-xs-4"><label>End Date</label></div>
        <div class="col-xs-1"><label>:</label></div>
        <div class="col-xs-6">
            <label><?php echo $records[0]['end_datetime']; ?></label>
        </div>
    </div>
</div>
<div class="clear" style="clear:both;height:1em"></div>
<div class="form-group">
    <div class="col-xs-12">
        <div class="col-xs-4"><label>Used Hours</label></div>
        <div class="col-xs-1"><label>:</label></div>
        <div class="col-xs-6">
            <label><?php echo $records[0]['finished_hours']; ?></label>
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


