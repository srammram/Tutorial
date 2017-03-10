<form name="project_form" id="project_form" method="post" action="<?php echo frontend_url() . 'projects/update'; ?>" data-parsley-validate="" enctype="multipart/form-data">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Edit Projects</h4>
        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $edit_id; ?>"/>
    </div>
    <?php
    $project_team = explode(',', $records[0]['project_team']);
    ?>
    <div class="modal-body" >
        <div class="form-group">
            <label >Project Title <span style="color:red">*</span></label>
            <input type="text" name="pro_title" id="pro_title" tabindex="1" class="form-control" placeholder="Enter Project Title" value="<?php echo $records[0]['project_name']; ?>"  required="" data-parsley-minlength="3" maxlength="500">
        </div>
        <div class="form-group">
            <label >Project Description <span style="color:red">*</span></label>
            <textarea name="pro_description" id="pro_description" class="form-control" rows="5"  style="resize: none" placeholder="Enter Project Description" required="" data-parsley-minlength="5" maxlength="5000"><?php echo $records[0]['project_description']; ?></textarea>

        </div>
        <div class="form-group">
            <label >Project Type <span style="color:red">*</span></label>
            <select name="pro_type" id="pro_type" class="form-control" required="" onchange="changereadonly(this.value, <?php echo $records[0]['project_type_status']; ?>)">
                <option value="">-Select Type-</option>
                <option value="1" <?php
                if ($records[0]['project_type_status'] == 1):echo "selected";
                endif;
                ?>>Ongoing</option>
                <option value="2" <?php
                if ($records[0]['project_type_status'] == 2):echo "selected";
                endif;
                ?>>Upcoming</option>
                <option value="3" <?php
                if ($records[0]['project_type_status'] == 3):echo "selected";
                endif;
                ?>>Pipeline</option>
            </select>
        </div>
        <!--        <div class="form-group">
                    <label>Upload File</label>
                    <input type="file" name="pro_file" id="pro_file" class="form-control"/>
                </div>-->
        <div id="project_select">
            <div class="form-group">
                <label>Project Estimation Start Date</label>
                <input type="text" name="pro_start" id="pro_start" readonly="" class="form-control" value="<?php echo $records[0]['project_start_date']; ?>"/>
            </div>
            <div class="form-group">
                <label>Project Estimation Finished Date</label>
                <input type="text" name="pro_finished" id="pro_finished" readonly="" class="form-control" value="<?php echo $records[0]['project_finished_date']; ?>"/>
            </div>
            <div class="form-group">
                <label>Duration Hours</label>
                <input type="text" name="pro_duration" id="pro_duration" class="form-control" value="<?php echo $records[0]['project_during_hours']; ?>" readonly=""/>
            </div>
            <div class="form-group">
                <label>Select Team This Project <span style="color:red">*</span></label><br>
                <select name="pro_team[]" id="pro_team" class="form-control" multiple="multiple" style="width:100%">
                    <option value="">-Select Team-</option>
                    <?php foreach ($team_details as $team): ?>
                        <option value="<?php echo $team['id']; ?>" <?php
                        if (in_array($team['id'], $project_team)):echo "selected";
                        endif;
                        ?>><?php echo $team['name']; ?></option>
                            <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-3 col-sm-offset-3">
                    <input type="submit" name="project-submit" id="project-submit" tabindex="4" class="form-control btn btn-primary" value="Update">
                </div>
                <div class="col-sm-3 ">
                    <input type="reset" name="project-reset" id="project-reset" tabindex="4" class="form-control btn btn-danger" value="Clear">
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    $(function () {
        return $('#pro_team').select2(
                {
                    placeholder: 'Select Teams'
                }
        );

    });

</script>

