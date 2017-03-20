<?php echo $this->load->view('layout/left-menu'); ?>
<div class="col-xs-12">
    <h1>Assigned Projects</h1>
    <div class="clear" style="clear: both;height:3em"></div>
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Assigned Projects
        </div>
        <div class="panel-body">
            <table id="assigned_projects_table" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th><input type="checkbox" name="selectall" id="selectall" value="selectall"/></th>
                        <th>S.No</th>
                        <th>Project Title</th>
                        <th>Project Description</th>
                        <th>Project Team</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($get_assigned_project_details)):
                        foreach ($get_assigned_project_details as $prodet):
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
                                $status = 'Completed';
                            endif;
                            ?>
                            <tr>
                                <td><input type="checkbox" class="selectthis" value="<?php echo $prodet['id']; ?>"/></td>
                                <td><?= ($prodet['id']); ?></td>
                                <td><?= stripslashes($prodet['project_name']); ?></td>
                                <td><?= stripslashes($prodet['project_description']); ?></td>
                                <td><?= stripslashes($prodet['department_name']); ?></td>
                                <td><label class="<?php echo $lableclass; ?>" style="font-size:12px"><?php echo $status; ?></label></td>
                                <td>
                                    <a href="#ViewAsignedProject" data-toggle="modal" class="btn btn-primary" onclick="getassignedproject_details(<?php echo $prodet['id']; ?>)"><i class="fa fa-eye"></i></a>
                                    <a href="#ChangeStatus" data-toggle="modal" class="btn btn-success" onclick="changestatus_forteamprojects(<?php echo $prodet['id']; ?>)" title="change finished status"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                            <?php
                        endforeach;
                    else:

                    endif;
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<div id="ViewAsignedProject" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content" id="viewassignedproject">

        </div>
    </div>
</div>
<div id="ChangeStatus" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content" id="changeasignproject">

        </div>
    </div>
</div>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $('#assigned_projects_table').DataTable();
    });

</script>