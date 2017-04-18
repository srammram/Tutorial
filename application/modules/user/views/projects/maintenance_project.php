<?php echo $this->load->view('layout/left-menu'); ?>
<div class="col-xs-12">
    <h1>Manage Maintenance Projects</h1>
    <div class="clear" style="clear: both;height:3em"></div>
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Manage Maintenance Projects
        </div>
        <div class="panel-body">
            <div class="col-xs-12" id="empsucc_message">

            </div>
            <table id="projects_table" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th><input type="checkbox" name="selectall" id="selectall" value="selectall"/></th>
                        <th>S.No</th>
                        <th>Project Title</th>
                        <th>Project Description</th>
                        <th>Project Type</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($get_maintenance_project_details as $prodet):

                        if ($prodet['status'] == 0):
                            $lableclass = "label label-warning";
                            $status = 'Pending';
                        elseif ($prodet['status'] == 1):
                            $lableclass = "label label-success";
                            $status = 'Active';
                        elseif ($prodet['status'] == 2):
                            $lableclass = "label label-danger";
                            $status = 'Ignored';
                        elseif ($prodet['status'] == 3):
                            $lableclass = "label label-primary";
                            $status = 'In Progress';
                        elseif ($prodet['status'] == 4):
                            $lableclass = "label label-warning";
                            $status = 'In Complete';
                        elseif ($prodet['status'] == 5):
                            $lableclass = "label label-success";
                            $status = 'Assigned';
                        elseif ($prodet['status'] == 6):
                            $lableclass = "label label-primary";
                            $status = 'Completed';
                        endif;
                        if ($prodet['project_type_status'] == 1):
                            $protype = 'Ongoing';
                        elseif ($prodet['project_type_status'] == 2):
                            $protype = 'Upcoming';
                        elseif ($prodet['project_type_status'] == 3):
                            $protype = 'Pipeline';
                        elseif ($prodet['project_type_status'] == 4):
                            $protype = 'Maintenance';
                        endif;
                        if ($prodet['project_type_status'] == 2 || $prodet['project_type_status'] == 3):
                            $lableclass = "label label-warning";
                            $status = "Yet to start";
                        elseif ($prodet['project_type_status'] == 4):
                            $lableclass = "label label-primary";
                            $status = "maintenance";
                        elseif ($prodet['status'] == 6):
                            $protype = 'Completed';
                        endif;
                        ?>
                        <tr>
                            <td><input type="checkbox" class="selectthis" value="<?php echo $prodet['id']; ?>"/></td>
                            <td><?= ($prodet['id']); ?></td>
                            <td><?= stripslashes($prodet['project_name']); ?></td>
                            <td><?= stripslashes($prodet['project_description']); ?></td>
                            <td><?= $protype; ?></td>
                            <td><label class="<?php echo $lableclass; ?>" style="font-size:12px"><?php echo $status; ?></label></td>
                        </tr>
                        <?php
                    endforeach;
                    ?>

                </tbody>
            </table>
            <div class="col-xs-12">
                <a href="javascript:void(0)" class="btn btn-danger" onclick="activate_users('departments', '3')">Delete</a>
            </div>
        </div>
    </div>
</div>
</div>
<div id="EditProject" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content" id="projectsedit">

        </div>
    </div>
</div>
<div id="AssignProject" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content" id="asignproject">

        </div>
    </div>
</div>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $('#projects_table').DataTable();
    });

</script>