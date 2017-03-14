<?php echo $this->load->view('layout/left-menu'); ?>
<div class="col-xs-12">
    <h1>Manage Assign Tasks</h1>
    <div class="clear" style="clear: both;height:3em"></div>
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Manage Assign Tasks
        </div>
        <div class="panel-body">
            <?php if ($_SESSION['user_type_id'] != 6): ?>
                <div class="col-xs-12">
                    <a href="javascript:void(0)" class="btn btn-danger" onclick="activate_users('departments', '3')">Delete</a>
                </div>
            <?php endif; ?>
            <div class="col-xs-12" id="empsucc_message">

            </div>
            <table id="manage_new_tasks" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th><input type="checkbox" name="selectall" id="selectall" value="selectall"/></th>
                        <th>S.No</th>
                        <th>Project Name</th>
                        <th>Task Title</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Message</th>
                        <th>Duration</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($records as $manage_tasks):

                        if ($manage_tasks['status'] == 1):
                            $labelclass = "label label-primary";
                            $status = "Active";
                        elseif ($manage_tasks['status'] == 3):
                            $labelclass = "label label-warning";
                            $status = "In Progress";
                        elseif ($manage_tasks['status'] == 4):
                            $labelclass = "label label-warning";
                            $status = "In Completed";
                        elseif ($manage_tasks['status'] == 5):

                            if ($manage_tasks['assigned_hours'] > $manage_tasks['finished_hours']):
                                $labelclass = "label label-success";
                                $status = "In Time Completed";
                            elseif ($manage_tasks['assigned_hours'] == $manage_tasks['finished_hours']):
                                $labelclass = "label label-primary";
                                $status = "On Time Completed";
                            elseif ($manage_tasks['assigned_hours'] < $manage_tasks['finished_hours']):
                                $labelclass = "label label-danger";
                                $status = "Delay Completed";
                            endif;
                        endif;
                        ?>
                        <tr>
                            <td><input type="checkbox" class="selectthis" value="<?php echo $manage_tasks['id']; ?>"/></td>
                            <td><?php echo $manage_tasks['id']; ?></td>
                            <td><?php echo $manage_tasks['project_name']; ?></td>
                            <td><?php echo $manage_tasks['task_name']; ?></td>
                            <td><?php echo $manage_tasks['from_name']; ?></td>
                            <td><?php echo $manage_tasks['to_name']; ?></td>
                            <td><?php echo $manage_tasks['asigned_message']; ?></td>
                            <td><?php echo $manage_tasks['assigned_hours']; ?></td>
                            <td><label class="<?php echo $labelclass; ?>"><?php echo $status; ?></label></td>
                            <td>
                                <a class="btn btn-success" href="#EditAsignTasks" data-toggle="modal" onclick="edit_asign_task(<?php echo $manage_tasks['id']; ?>);"><i class="fa fa-edit" ></i></a>
                            </td>
                        </tr>
                        <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div id="ViewAsignTasks" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content" id="view_asign_task">

            </div>
        </div>
    </div>
    <div id="EditAsignTasks" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content" id="edit_asign_task">

            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $('#manage_new_tasks').DataTable();
    });

</script>