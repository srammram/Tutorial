<form name="asign_project" id="asign_project" method="post" data-parsley-validate="" action="">
    <?php
//    echo count($project_team_details);
    $department_id = explode(',', $records[0]['project_team']);
    ?>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Assigned Project</h4>
    </div>

    <div class="modal-body" >
        <div class="col-xs-12" id="err_message">

        </div>
        <div class="form-group">
            <label>Project Estimated Hours</label>
            <input type="text" name="pro_total_hours" id="pro_total_hours" class="form-control" readonly="" value="<?php echo $records[0]['project_during_hours'] . ' Hours'; ?>"/>
        </div>
        <div class="form-group">
            <label>Selected Team</label>
            <br>

            <select disabled="" name="pro_asign_team[]" id="pro_asign_team" class="form_control" required="" multiple="" style="width:100%">
                <?php foreach ($departments as $alldepartments): ?>
                    <option value="<?php echo $alldepartments['id'] ?>" <?php
                    if (in_array($alldepartments['id'], $department_id)): echo "selected";
                    endif;
                    ?>><?php echo $alldepartments['name']; ?></option>
                        <?php endforeach;
                        ?>
            </select>
        </div>
        <?php for ($i = 0; $i < count($project_team_name); $i++): ?>
            <div class="form-group ">
                <label><?php echo $project_team_name[$i]; ?> Team <span style="color:red">*</span></label>
                <br>
                <input type="text" name="team_duration_hours[]" disabled="" class="form-control" placeholder="Enter Duration Hours" required="" data-parsley-type="number" value="<?php echo $project_team_details[$i]['time_duration']; ?>"/>
                <div class="clear" style="clear: both;height:1em"></div>
                <select style="width:100%" name="select_team_tl[]" disabled="" id="select_team_tl" class="form-control" required="">
                    <option value="">-Select Team TL-</option>
                    <?php
                    foreach ($tl_details[$i] as $det):
                        ?>
                        <option value="<?php echo $det['id']; ?>" <?php
                        if ($det['id'] == $project_team_details[$i]['team_tl_id']): echo "selected";
                        endif;
                        ?>><?php echo $det['user_name']; ?></option>
                            <?php endforeach; ?>
                </select>

            </div>

            <?php
        endfor;
        ?>
        <div class="form-group">
            <input type="hidden" name="project_id" id="project_id" class="form-control" value="<?php echo $project_id; ?>"/>
        </div>
    </div>
    <div class="modal-footer">
        <div id="assign_err_message"></div>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</form>
<script type="text/javascript">

    $('#pro_asign_team,#select_team_tl').select2(
            {
                placeholder: 'Select Team Leader'
            }
    );


</script>


