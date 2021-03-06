<?php echo $this->load->view('layout/left-menu'); ?>
<div class="col-xs-12">
    <h1>Manage Tasks</h1>
    <div class="clear" style="clear: both;height:3em"></div>
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Manage Tasks
        </div>
        <div class="panel-body">
            <?php if ($_SESSION['user_type_id'] != 6): ?>
                <div class="col-xs-12">
                    <a href="javascript:void(0)" class="btn btn-danger" onclick="activate_users('task_history', '2')">Delete</a>
                </div>
            <?php endif; ?>
            <div class="col-xs-12" id="empsucc_message">

            </div>
            <table id="projects_table" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th><input type="checkbox" name="selectall" id="selectall" value="selectall"/></th>
                        <th>S.No</th>
                        <th>Task Title</th>
                        <th>Description</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Duration</th>
                        <th>Type</th>
                        <th>Task Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($task_details)):
                        foreach ($task_details as $taskdet):
                            $assigned_date = $taskdet['assigned_datetime'];
                            $finished_datetime = $taskdet['finished_datetime'];
                            $employee_finished_datetime = $taskdet['employee_finished_datetime'];
                            $currentdatetime = date('Y-m-d H:i:s');
//                            if ($taskdet['status'] != 6 && $taskdet['status'] != 3):
//                                if ($assigned_date < $currentdatetime):
//                                    if ($finished_datetime < $currentdatetime):
//                                        $prostatus = "<label class='label label-danger'>Task Delayed</label>";
//                                    else:
//                                        $prostatus = "<label class='label label-warning'>Task Ongoing</label>";
//                                    endif;
//                                else:
//                                    $prostatus = "<label class='label label-primary'>Task Pending</label>";
//                                endif;
//                            elseif ($taskdet['status'] == 6):
//                                if ($assigned_date < $employee_finished_datetime):
//                                    $prostatus = "<label class='label label-danger'>Task Finished Delayed</label>";
//                                else:
//                                    $prostatus = "<label class='label label-danger'>Task Properly Finished</label>";
//                                endif;
//                            endif;
                            if ($taskdet['status'] == 0):
                                $lableclass = "label label-warning";
                                $status = 'Pending';
                            elseif ($taskdet['status'] == 1):
                                $lableclass = "label label-success";
                                $status = 'Active';
                            elseif ($taskdet['status'] == 2):
                                $lableclass = "label label-danger";
                                $status = 'Ignored';
                            elseif ($taskdet['status'] == 3):
                                $lableclass = "label label-warning";
                                $status = 'In Progress';
                            elseif ($taskdet['status'] == 4):
                                $lableclass = "label label-success";
                                $status = 'Completed';
                            elseif ($taskdet['status'] == 5):
                                $lableclass = "label label-danger";
                                $status = 'Postponed';
                            endif;
                            if ($taskdet['task_type'] == 1):
                                $typetask = "Assigned";
                            else:
                                $typetask = "Add";
                            endif;
                            ?>
                            <tr>
                                <td><input type="checkbox" class="selectthis" value="<?php echo $taskdet['id']; ?>"/></td>
                                <td><?= ($taskdet['id']); ?></td>
                                <td><?= ($taskdet['task_title'] != '') ? stripslashes($taskdet['task_title']) : 'N/A'; ?></td>
                                <td><?= $taskdet['message'] != '' ? stripslashes($taskdet['message']) : 'N/A'; ?></td>
                                <?php if ($taskdet['task_type'] == 1 && $taskdet['task_type'] != 6): ?>
                                    <td><?= $taskdet['from_username']; ?></td>
                                    <td><?= $taskdet['to_user_name']; ?></td>
                                <?php else: ?>
                                    <td><?= 'N/A'; ?></td>
                                    <td><?= 'N/A'; ?></td>
                                <?php endif; ?>
                                <td><?= $taskdet['project_duration']; ?></td>
                                <td><?= $typetask; ?></td>
                                <td><label class="<?php echo $lableclass; ?>"><?php echo $status; ?></label></td>
                                <td>
                                    <?php if ($_SESSION['user_id'] == $taskdet['from_user_id']): ?>
                                        <?php if ($_SESSION['user_type_id'] != 6): ?>
                                            <a  class="btn btn-success" href="#EditTask" data-toggle="modal" onclick="edittask(<?php echo $taskdet['id']; ?>)"><i class="fa fa-edit"></i></a>
                                        <?php else: ?>
                                            <a  class="btn btn-primary" href="#EditTask" data-toggle="modal" onclick="edittask(<?php echo $taskdet['id']; ?>)"><i class="fa fa-eye"></i></a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php if ($_SESSION['user_type_id'] != 6 && $taskdet['task_type'] == 2): ?>
                                        <a  class="btn btn-primary" href="#ChangeStatus" data-toggle="modal" onclick="changetaskstatus(<?php echo $taskdet['id']; ?>)"><i class="fa fa-tasks"></i></a>                                       
                                        <?php
                                    endif;
                                    ?>
                                    <?php if ($_SESSION['user_type_id'] != 6): ?>
                                        <a href="javascript:void(0)" class="btn btn-danger" onclick="delete_actions(<?php echo $taskdet['id']; ?>, 'task_history')"><i class="fa fa-trash"></i></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php
                        endforeach;
                    else:
                        echo "No Records Found";
                    endif;
                    ?>

                </tbody>
            </table>
            <?php if ($_SESSION['user_type_id'] != 6): ?>
                <div class="col-xs-12">
                    <a href="javascript:void(0)" class="btn btn-danger" onclick="activate_users('departments', '3')">Delete</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>
<div id="EditTask" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content" id="taskedit">

        </div>
    </div>
</div>
<div id="ChangeStatus" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content" id="change_status">

        </div>
    </div>
</div>

<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $('#projects_table').DataTable();
    });

</script>