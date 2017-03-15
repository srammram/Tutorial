
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
            <label><?php echo $records[0]['project_description']; ?></label>
        </div>
    </div>
</div>
<div class="clear" style="clear:both;height:1em"></div>
<div class="form-group">
    <div class="col-xs-12">
        <div class="col-xs-4"><label>Project Teams</label></div>
        <div class="col-xs-1"><label>:</label></div>
        <div class="col-xs-6">
            <label><?php echo implode(',', $team_details); ?></label>
        </div>
    </div>
</div>
<div class="clear" style="clear:both;height:1em"></div>
<div class="form-group">

    <div class="col-xs-12">
        <div class="col-xs-4"><label>Estimated Hours</label></div>
        <div class="col-xs-1"><label>:</label></div>
        <div class="col-xs-6">
            <label><?php echo $records[0]['project_during_hours']; ?></label>
        </div>
    </div>
</div>
<div class="clear" style="clear:both;height:1em"></div>
<div class="form-group">
    <div class="col-xs-12">
        <div class="col-xs-4"><label>Start Date</label></div>
        <div class="col-xs-1"><label>:</label></div>
        <div class="col-xs-6">
            <label><?php echo $records[0]['project_start_date']; ?></label>
        </div>
    </div>
</div>
<div class="clear" style="clear:both;height:1em"></div>
<div class="form-group">
    <div class="col-xs-12">
        <div class="col-xs-4"><label>End Date</label></div>
        <div class="col-xs-1"><label>:</label></div>
        <div class="col-xs-6">
            <label><?php echo $records[0]['project_finished_date']; ?></label>
        </div>
    </div>
</div>
<div class="clear" style="clear:both;height:1em"></div>
<?php
$i = 0;
foreach ($team_details as $details):
    ?>
    <div class="clear" style="clear:both;height:0.5em"></div>
    <div class="form-group">
        <div class="col-xs-12">
            <div class="col-xs-4"><label><?php echo $details ?> Team Duration Hours</label></div>
            <div class="col-xs-1"><label>:</label></div>
            <div class="col-xs-6">
                <?php if ($time_duration[$i] != ''): ?>
                    <label><?php echo $time_duration[$i]; ?> Hours</label>
                <?php else: ?>
                    <label>Not Assigned</label>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="clear" style="clear:both;height:0.5em"></div>
    <div class="form-group">
        <div class="col-xs-12">
            <div class="col-xs-4"><label><?php echo $details ?> Team Used Hours</label></div>
            <div class="col-xs-1"><label>:</label></div>
            <div class="col-xs-6">
                <?php if ($team_used_hours[$i] != ''): ?>
                    <label><?php echo $team_used_hours[$i]; ?> Hours</label>
                <?php else: ?>
                    <label>N/A</label>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="clear" style="clear:both;height:1em"></div>
    <div class="form-group">
        <div class="col-xs-12">
            <div class="col-xs-4"><label><?php echo $details ?> Team Finished Hours</label></div>
            <div class="col-xs-1"><label>:</label></div>
            <div class="col-xs-6">
                <?php if ($finished_hours[$i] != '0'): ?>
                    <label><?php echo $finished_hours[$i]; ?> Hours</label>
                <?php else: ?>
                    <label>Not Finished</label>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="clear" style="clear:both;height:1em"></div>
    <div class="form-group">
        <div class="col-xs-12">
            <div class="col-xs-4">
                <label><?php echo $details ?> Team Status</label>
            </div>
            <div class="col-xs-1"><label>:</label></div>
            <div class="col-xs-6">
                <?php
                if ($team_status[$i] == '1'):
                    $status = "Active";
                    $labelclass = "label label-primary";
                elseif ($team_status[$i] == '2'):
                    $status = "Ignored";
                    $labelclass = "label label-danger";
                elseif ($team_status[$i] == '3'):
                    $status = "In Progress";
                    $labelclass = "label label-warning";
                elseif ($team_status[$i] == '4'):
                    $status = "In Completed";
                    $labelclass = "label label-danger";
                elseif ($team_status[$i] == '5'):
                    $status = "Completed";
                    $labelclass = "label label-success";
                endif;
                ?>
                <label class="<?php echo $labelclass ?>" style="font-size:15px"><?php echo $status; ?></label>
            </div>

        </div>

    </div>
    <?php
    $progress = round(($team_used_hours[$i] * 100) / $time_duration[$i]);
    ?>
    <div class="clear" style="clear:both;height:1em"></div>
    <?php if ($progress != 0): ?>
        <div class="form-group">
            <div class="col-xs-12">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: <?php echo $progress; ?>%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"><?php echo $progress . ' % time is used'; ?></div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="clear" style="clear:both;height:1em;border-bottom: 1px dotted silver"></div>
    <?php
    $i++;
endforeach;
?>
<div class="clear" style="clear:both;height:1em"></div>

