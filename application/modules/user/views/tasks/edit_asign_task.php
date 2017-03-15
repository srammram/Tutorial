
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Edit Task</h3>
</div>
<div class="modal-body">
    <form name="asign_edit_task" id="asign_edit_task" method="post" action="<?php echo frontend_url() . 'tasks/update_asign_task'; ?>" data-parsley-validate="">
        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $records[0]['id']; ?>"/>
        <div class="form-group">
            <label>Select Project <span style="color:red">*</span></label>
            <select name="asign_project" id="asign_project" class="form-control" required="" <?php if ($_SESSION['user_type_id'] == 5): ?> onchange="get_user_details(<?php echo $_SESSION['user_departments_id'] ?>);"<?php endif; ?>>
                <option value="">-Select Project-</option>
                <?php foreach ($project_details as $details): ?>
                    <option value="<?php echo $details['projects_id']; ?>" <?php
                    if ($records[0]['projects_id'] == $details['projects_id']): echo "selected";
                    endif;
                    ?>><?php echo $details['project_name']; ?></option>
                        <?php endforeach; ?>

            </select>
        </div>
        <?php
        $mediafiles = explode('|*|', $records[0]['task_file']);
        if ($_SESSION['user_type_id'] != 5):
            ?>
            <div class="form-group">
                <label>Select User Type <span style="color:red">*</span></label>
                <select name="asign_usertype" id="asign_usertype" class="form-control" required="" onchange="getdepartments(this.value)">
                    <option value="">-Select User Type-</option>
                    <?php foreach ($usertype_details as $details): ?>
                        <option value="<?php echo $details['id']; ?>" <?php
                        if ($details['id'] == $records[0]['user_type_id']): echo "selected";
                        endif;
                        ?>><?php echo $details['type_name']; ?></option>
                            <?php endforeach; ?>

                </select>
            </div>
        <?php endif; ?>
        <div id="departments_details" class="form-group" <?php if ($_SESSION['user_type_id'] == 5): ?>style="display:none"<?php endif; ?>>
            <div class="clear" style="clear: both;height:1em"></div>
            <label>Select Departments <span style="color:red">*</span></label>
            <select style="width:100%" name="asign_departments" id="asign_departments" class="form-control" onchange="get_user_details(this.value)">
                <option value="">-Select Department-</option>
                <?php foreach ($department_details as $details): ?>
                    <option <?php
                    if ($details['id'] == $records[0]['departments_id']): echo "selected";
                    endif;
                    ?> value="<?php echo $details['id']; ?>" <?php
                        if ($details['id'] == $records[0]['departments_id']): echo "selected";
                        endif;
                        ?>><?php echo $details['name']; ?></option>
                    <?php endforeach; ?>

            </select>
        </div>
        <div class="form-group">
            <label>Select Employee <span style="color:red">*</span></label>
            <select name="asign_user_details" id="asign_user_details" class="form-control" required="">
                <option value="">-Select Employee</option>
                <?php
                foreach ($employee_details as $details):
                    ?>
                    <option value="<?php echo $details['id'] ?>" <?php
                    if ($details['id'] == $records[0]['assigned_to']): echo "selected";
                    endif;
                    ?>><?php echo $details['user_name']; ?></option>
                        <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Task Title <span style="color:red">*</span></label>
            <input value="<?php echo $records[0]['task_name']; ?>" type="text" name="asign_task_title" id="asign_task_title" required="" class="form-control" placeholder="Enter Task Title"/>
        </div>
        <div class="form-group">
            <label>Message <span style="color:red">*</span></label>
            <textarea placeholder="Enter Message" name="asign_task_message" id="asign_task_message" class="form-control" rows="5" style="resize:none" required="" data-parsley-minlength="5" maxlength="1000"><?php echo $records[0]['asigned_message']; ?></textarea>
        </div>
        <div class="form-group">
            <label>Start Date <span style="color:red">*</span></label>
            <input type="text" required="" name="asign_start_date" id="asign_start_date" class="form-control" placeholder="Choose Start Date" value="<?php echo date('m/d/Y h:i a', strtotime($records[0]['start_datetime'])); ?>"/>
        </div>
        <div class="form-group">
            <label>End Date <span style="color:red">*</span></label>
            <input type="text" required="" name="asign_end_date" id="asign_end_date" class="form-control" placeholder="Choose End Date" value="<?php echo date('m/d/Y h:i a', strtotime($records[0]['end_datetime'])); ?>"/>
        </div>
        <div class="form-group">
            <label>Enter Duration Hours <span style="color:red">*</span></label>
            <input type="text" required="" name="asign_duration_hours" id="add_duration_hours" class="form-control" placeholder="Choose Duration Hours" value="<?php echo $records[0]['assigned_hours']; ?>"/>
        </div>
        <div class="form-group">
            <label>Select Files</label>
            <div class="dropzone" id="taskFiles" name="taskFilesFileUploader"></div>
            <div id="projecttaskFilesHiddenContainer">
                <?php
                foreach ($mediafiles as $media) {

                    echo "<input type=\"hidden\" name=\"mediaFiles_stopped[]\" value=\"" . $media . "\" id='news_media_img_" . $media . "' />";
                }
                ?>
            </div>
        </div>
        <script type="text/javascript">
            var taskFilesDropzoneOptions = {
                url: "<?php echo frontend_url(); ?>tasks/upload_files",
                maxFiles: 5,
                addRemoveLinks: true,
                acceptedFiles: 'image/*,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel.sheet.macroEnabled.12,text/plain',
                success: function (file, response, e) {

                    response = JSON.parse(response);
                    if (response.success == 0) {
                        this.defaultOptions.error(file, response.message);
                    } else {
                        var input = document.createElement("input");
                        input.setAttribute("type", "hidden");
                        input.setAttribute("name", "mediaFiles[]");
                        input.value = response.file;
                        file.previewElement.appendChild(input);
                    }
                },
                init: function () {
                    this.on("sending", function (file, xhr, formData) {
                        var news_type = $('input:radio[name=news_type]:checked').val();
                        formData.append("news_type", news_type);
                    });
<?php
foreach ($mediafiles as $media) {

    $filetype = explode('.', $media);
    $fileurl = base_url() . 'media/task/' . $media;
    //    $filesize = filesize($fileurl);
    ?>
                        var mockFile = {
                            name: '<?php echo $media; ?>',
                            accepted: true,
                            url: '<?php echo $fileurl; ?>',
                            status: Dropzone.SUCCESS,
                            upload: {progress: 100}
                        };
                        this.files.push(mockFile);
                        this.emit('addedfile', mockFile);
                        mockFile.previewElement.classList.remove("dz-file-preview");
                        _ref = mockFile.previewElement.querySelectorAll("[data-dz-thumbnail]");
                        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                            thumbnailElement = _ref[_i];
                            thumbnailElement.src = mockFile.url;
                            thumbnailElement.style.maxHeight = '100%';
                        }

                        var input = document.createElement("input");
                        input.setAttribute("type", "hidden");
                        input.setAttribute("name", "mediaFiles[]");
                        input.value = '<?php echo $media; ?>';
                        mockFile.previewElement.appendChild(input);

                        this.emit('complete', mockFile);
                        this._updateMaxFilesReachedClass();
<?php } ?>
                }
            };
            var taskFilesDropzone = new Dropzone("div#taskFiles", taskFilesDropzoneOptions);

        </script>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-3 col-sm-offset-3">
                    <input type="submit" name="asign-task-submit" id="task-submit" tabindex="4" class="form-control btn btn-primary" value="Update">
                </div>
                <div class="col-sm-3 ">
                    <input type="reset" name="asign-task-reset" id="task-reset" tabindex="4" class="form-control btn btn-danger" value="Clear">
                </div>
            </div>
        </div>
    </form>
</div>
</div>
</div>
</div>
<script type="text/javascript">

    $(function () {
        $('#asign_start_date').datetimepicker({
            daysOfWeekDisabled: [0],
            useCurrent: false,
        });
        $('#asign_end_date').datetimepicker({
            useCurrent: false,
        });
        $("#asign_start_date").on("dp.change", function (e) {
            $('#asign_end_date').data("DateTimePicker").minDate(e.date);
        });


    });
</script>