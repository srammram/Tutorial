
<form name="edit_new_task_form" id="edit_new_task_form" method="post"  data-parsley-validate="" enctype="multipart/form-data">
    <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>View Dependency</h3>
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
                <div class="col-xs-4"><label>Task Title</label></div>
                <div class="col-xs-1"><label>:</label></div>
                <div class="col-xs-6">
                    <?php if ($records[0]['task_title'] != ''): ?>
                        <label><?php echo $records[0]['task_title']; ?></label>

                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="clear" style="clear: both;height:1em"></div>
        <div class="form-group">
            <div class="col-xs-12">
                <div class="col-xs-4"><label>Department Name</label></div>
                <div class="col-xs-1"><label>:</label></div>
                <div class="col-xs-6">
                    <?php if ($records[0]['department_name'] != ''): ?>
                        <label><?php echo $records[0]['department_name']; ?></label>

                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="clear" style="clear: both;height:1em"></div>
        <div class="form-group">
            <div class="col-xs-12">
                <div class="col-xs-4"><label>Set Datetime</label></div>
                <div class="col-xs-1"><label>:</label></div>
                <div class="col-xs-6">
                    <?php if ($records[0]['set_datetime'] != '0'): ?>
                        <label><?php echo $records[0]['set_datetime']; ?></label>
                    <?php else: ?>
                        <label><?php echo "N/A"; ?></label>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="clear" style="clear: both;height:1em"></div>
        <div class="form-group">
            <div class="col-xs-12">
                <div class="col-xs-4"><label>Unset Datetime</label></div>
                <div class="col-xs-1"><label>:</label></div>
                <div class="col-xs-6">
                    <?php if ($records[0]['unset_datetime'] != 0): ?>
                        <label><?php echo $records[0]['unset_datetime']; ?></label>
                    <?php else: ?>
                        <label><?php echo "N/A"; ?></label>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="clear" style="clear: both;height:1em"></div>
        <div class="form-group">
            <div class="col-xs-12">
                <div class="col-xs-4"><label>Status</label></div>
                <div class="col-xs-1"><label>:</label></div>
                <div class="col-xs-6">
                    <?php if ($records[0]['dependency_status'] != ''): ?>
                        <label><?php echo $records[0]['dependency_status']; ?></label>
                    <?php else: ?>
                        <label><?php echo "Others"; ?></label>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <input type="button" name="task_close" id="task_close" class="btn btn-danger" value="Close" style="float:right" data-dismiss="modal" aria-hidden="true"/>
        </div>
        <div class="clear" style="clear: both;height:2em"></div>
    </div>
</form>