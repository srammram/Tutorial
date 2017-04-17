<?php echo $this->load->view('layout/left-menu'); ?>

<h1>Add Projects</h1>

<div class="col-xs-offset-2 col-xs-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="text-center">Add Projects</h3>
        </div>
        <div class="panel-body">
            <form name="project_form" id="project_form" method="post" action="<?php echo frontend_url() . 'projects/insert'; ?>" data-parsley-validate="" enctype="multipart/form-data">
                <div class="form-group">
                    <label >Project Title <span style="color:red">*</span></label>
                    <input type="text" name="pro_title" id="pro_title" tabindex="1" class="form-control" placeholder="Enter Project Title" value=""  required="" data-parsley-minlength="3" maxlength="500">
                </div>
                <div class="form-group">
                    <label >Project Description <span style="color:red">*</span></label>
                    <textarea name="pro_description" id="pro_description" class="form-control" rows="5"  style="resize: none" placeholder="Enter Project Description" required="" data-parsley-minlength="5" maxlength="5000"></textarea>

                </div>
                <div class="form-group">
                    <label >Project Type <span style="color:red">*</span></label>
                    <select name="pro_type" id="pro_type" class="form-control" required="" onchange="projectselection(this.value)">
                        <option value="">-Select Type-</option>
                        <option value="1">Ongoing</option>
                        <option value="2">Upcoming</option>
                        <option value="3">Pipeline</option>
                        <option value="4">Maintenance</option>
                    </select>
                </div>

                <div id="project_select">
                    <div class="form-group">
                        <label>Project Estimation Start Date</label>
                        <input type="text" name="pro_start" id="pro_start" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Project Estimation Finished Date</label>
                        <input type="text" name="pro_finished" id="pro_finished" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Duration Hours</label>
                        <input type="text" name="pro_duration" id="pro_duration" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label>Select Team This Project <span style="color:red">*</span></label>
                        <select name="pro_team[]" id="pro_team" class="form-control" multiple="multiple">
                            <option value="">-Select Team-</option>
                            <?php foreach ($team_details as $team): ?>
                                <option value="<?php echo $team['id']; ?>"><?php echo $team['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Select Files</label>
                        <div class="dropzone" id="projectsFiles" name="projectsFilesFileUploader"></div>
                        <input id="projectFileHidden" type="hidden" name="thumbnail" value="" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-sm-offset-3">
                            <input type="submit" name="project-submit" id="project-submit" tabindex="4" class="form-control btn btn-primary" value="Add">
                        </div>
                        <div class="col-sm-3 ">
                            <input type="reset" name="project-reset" id="project-reset" tabindex="4" class="form-control btn btn-danger" value="Clear">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    var projectsFilesDropzoneOptions = {
        url: "<?php echo frontend_url(); ?>projects/upload_files",
        maxFiles: 5,
        addRemoveLinks: true,
        acceptedFiles: 'image/*,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel.sheet.macroEnabled.12,text/plain',
        maxfilesexceeded: function (file) {
            this.removeAllFiles();
            this.addFile(file);
        },
        success: function (file, response, e) {
            response = JSON.parse(response);
            if (response.success == 0) {
                this.defaultOptions.error(file, response.message);
            } else {
                var input = document.createElement("input");
                input.setAttribute("type", "hidden");
                input.setAttribute("name", "mediaFiles[]");
                input.value = response.file;
                file.name = response.file;
                file.previewElement.appendChild(input);
            }
        },
        init: function () {
            this.on("sending", function (file, xhr, formData) {
                var news_type = $('input:radio[name=news_type]:checked').val();
                formData.append("news_type", news_type);
            });
        }
    };
    var projectsFilesDropzone = new Dropzone("div#projectsFiles", projectsFilesDropzoneOptions);
    projectsFilesDropzone.on("removedfile", (function (_this) {
        return function (file) {
            document.getElementById("projectFileHidden").value = '';
        };
    })(projectsFilesDropzone));

    var date = new Date();
    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());

    $("#pro_start").datepicker({
        todayBtn: false,
        autoclose: true,
        todayHighlight: true,
        startDate: today,
        format: "yyyy-mm-dd",
        weekStart: 0,
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $('#pro_finished').datepicker('setStartDate', minDate);
        var cc = $('#pro_start').val();
    });

    $("#pro_finished").datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
    }).on('changeDate', function (selected) {
        var maxDate = new Date(selected.date.valueOf());
        $('#pro_start').datepicker('setEndDate', maxDate);
        var start_date = $('#pro_start').val();
        var end_date = $('#pro_finished').val();
        $.ajax({
            url: FRONTEND_URL + 'calculatehours',
            data: {start_date: start_date, end_date: end_date},
            dataType: 'json',
            type: 'post',
            success: function (output) {
                $('#pro_duration').val(output.total_hours);
            }
        })
    });

    $('#filename').change(function () {
        var val = $(this).val().toLowerCase();
        var regex = new RegExp("(.*?)\.(jpg|jpeg|png|gif|docx|doc|pdf|txt)$");
        if (!(regex.test(val))) {
            $('#pro_file').val('');
            alert('Invalid file format. Upload only .jpg,.jpeg,.png,.gif,.docx,.doc,.pdf,.txt');
        }
    });
//    $(document).ready(function () {
//        var newsThumbnailDropzoneOptions = {
//            url: "<?php echo frontend_url(); ?>news/upload_thumbnail",
//            maxFiles: 1,
//            addRemoveLinks: true,
//            acceptedFiles: 'image/*',
//            maxfilesexceeded: function (file) {
//                this.removeAllFiles();
//                this.addFile(file);
//            },
//            success: function (file, response, e) {
//                response = JSON.parse(response);
//                if (response.success == 0) {
//                    this.defaultOptions.error(file, response.message);
//                } else {
//                    document.getElementById("newsThumbnailHidden").value = response.file;
//                }
//            }
//        };
//        var newsThumbnailDropzone = new Dropzone("div#newsThumbnail", newsThumbnailDropzoneOptions);
//        newsThumbnailDropzone.on("removedfile", (function (_this) {
//            return function (file) {
//                document.getElementById("newsThumbnailHidden").value = '';
//            };
//        })(newsThumbnailDropzone));
//    });
</script>


