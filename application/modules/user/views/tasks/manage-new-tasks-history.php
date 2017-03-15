<?php echo $this->load->view('layout/left-menu'); ?>
<div class="col-xs-12">
    <h1> Manage Task History</h1>
    <div class="clear" style="clear: both;height:3em"></div>
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Manage Task History
            <a href="<?php echo frontend_url() . 'tasks/manage_new_task'; ?>" class="btn btn-danger" style="float:right">Back</a>
            <a href="<?php echo frontend_url() . 'tasks/add_new_task'; ?>" class="btn btn-success" style="float:right">Add</a>
            <div class="clear" style="clear: both;height:0.1em"></div>
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
                        <th>Description</th>
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
                            $labelclass = "label label-success";
                            $status = "In Completed";
                        elseif ($manage_tasks['status'] == 5):
                            if ($manage_tasks['projects_id'] != 'others'):
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
                            else:
                                $status = "Completed";
                            endif;
                        endif;
                        ?>
                        <tr>
                            <td><input type="checkbox" class="selectthis" value="<?php echo $manage_tasks['id']; ?>"/></td>
                            <td><?php echo $manage_tasks['id']; ?></td>
                            <?php if ($manage_tasks['projects_id'] == 'others'): ?>
                                <td><?php echo $manage_tasks['projects_id']; ?></td>
                            <?php else: ?>
                                <td><?php echo $manage_tasks['project_name']; ?></td>
                            <?php endif; ?>
                            <td><?php echo $manage_tasks['task_title']; ?></td>
                            <td><?php echo $manage_tasks['message']; ?></td>
                            <td><?php echo $manage_tasks['project_duration']; ?></td>
                            <td><label class="<?php echo $labelclass; ?>"><?php echo $status; ?></label></td>
                            <td>
                                <a class="btn btn-primary" href="#EditTasks" data-toggle="modal" onclick="edittaskdetails(<?php echo $manage_tasks['id'] ?>);"><i class="fa fa-eye" ></i></a>
                            </td>
                        </tr>
                        <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div id="EditTasks" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content" id="edit_new_task">

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