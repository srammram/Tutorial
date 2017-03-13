<form name="change_status_project" id="change_status_project" method="post" data-parsley-validate="" action="<?php echo frontend_url() . 'projects/change_project_status'; ?>">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Change status for this project</h4>
    </div>
    <div class="modal-body">
        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $project_id; ?>"/>
        <div class="form-group">
            <select name="change_status" id="change_status" class="form-control" required="">
                <option value="">-Select Status-</option>
                <option value="3">In Progress</option>
                <option value="4">In Completed</option>
                <option value="5">Completed</option>
            </select>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-3 col-sm-offset-3">
                    <input type="submit" name="status-submit" id="status-submit" tabindex="4" class="form-control btn btn-primary" value="Update">
                </div>
                <div class="col-sm-3 ">
                    <input type="button" name="status-close" id="task-close" tabindex="4" class="form-control btn btn-danger" value="Close"  data-dismiss="modal" aria-hidden="true">
                </div>
            </div>
        </div>
    </div>
</form>