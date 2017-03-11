<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">Assigned Project</h4>
</div>
<div class="modal-body" >
    <div class="col-xs-12" id="err_message">

    </div>
    <div class="form-group">
        <label>Project Title</label>
        <p style="color:#333;font-size:18px"><?php echo $records[0]['project_name']; ?></p>
    </div>
    <div class="form-group">
        <label>Project Description</label>
        <p style="color:#333;font-size:18px;word-wrap: break-word"><?php echo $records[0]['project_description']; ?></p>
    </div>
    <div class="form-group">
        <label>Duration Hours</label>
        <p style="color:#333;font-size:18px;word-wrap: break-word"><?php echo $records[0]['time_duration'] . ' Hours'; ?></p>
    </div>
    <div class="form-group">
        <label>Created Time</label>
        <p style="color:#333;font-size:18px;word-wrap: break-word"><?php echo $records[0]['created_at']; ?></p>
    </div>
    <div class="form-group">
        <label>Assigned By</label>
        <p style="color:#333;font-size:18px;word-wrap: break-word"><?php echo $records[0]['user_name']; ?></p>
    </div>
    <div class="form-group">
        <label>Project File</label>
        <br>
        <a href="<?php echo frontend_url() . 'projects/download_files/' . $records[0]['project_file']; ?>" style="font-size:20px" class="btn btn-success" >Download</a>
    </div>
</div>
<div class="modal-footer">

</div>
