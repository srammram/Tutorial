<?php echo $this->load->view('layout/left-menu'); ?>
<div class="col-xs-12">
    <h1>Manage Tasks</h1>
    <div class="clear" style="clear: both;height:3em"></div>
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Manage Tasks
        </div>
        <div class="panel-body">
            <div class="col-xs-12">
                <a href="javascript:void(0)" class="btn btn-danger" onclick="activate_users('departments', '3')">Delete</a>
            </div>
            <div class="col-xs-12" id="empsucc_message">

            </div>
            <table id="projects_table" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th><input type="checkbox" name="selectall" id="selectall" value="selectall"/></th>
                        <th>S.No</th>
                        <th>Project Title</th>
                        <th>Project Description</th>
                        <?php
                        if ($_SESSION['user_type_id'] == 5):
                            ?>
                            <th>Assigned To</th>
                        <?php elseif ($_SESSION['user_type_id'] == 6): ?>
                            <th>Assigned From</th>
                        <?php else:
                            ?>
                            <th>Assigned To</th>
                            <th>Assigned From</th>
                        <?php endif; ?>
                        <th>Duration</th>
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
                            if ($taskdet['status'] != 6 && $taskdet['status'] != 3):
                                if ($assigned_date < $currentdatetime):
                                    if ($finished_datetime < $currentdatetime):
                                        $prostatus = "<label class='label label-danger'>Task Delayed</label>";
                                    else:
                                        $prostatus = "<label class='label label-warning'>Task Ongoing</label>";
                                    endif;
                                else:
                                    $prostatus = "<label class='label label-primary'>Task Pending</label>";
                                endif;
                            elseif ($taskdet['status'] == 6):
                                if ($assigned_date < $employee_finished_datetime):
                                    $prostatus = "<label class='label label-danger'>Task Finished Delayed</label>";
                                else:
                                    $prostatus = "<label class='label label-danger'>Task Properly Finished</label>";
                                endif;
                            endif;
                            if ($taskdet['status'] == 0):
                                $lableclass = "label label-warning";
                                $status = 'Pending';
                            elseif ($taskdet['status'] == 1):
                                $lableclass = "label label-success";
                                $status = 'Active';
                            elseif ($taskdet['status'] == 2):
                                $lableclass = "label label-danger";
                                $status = 'Ignored';
                            elseif ($taskdet['status'] == 6):
                                $lableclass = "label label-primary";
                                $status = 'Assigned';
                            endif;
                            ?>
                            <tr>
                                <td><input type="checkbox" class="selectthis" value="<?php echo $taskdet['id']; ?>"/></td>
                                <td><?= ($taskdet['id']); ?></td>
                                <td><?= stripslashes($taskdet['project_name']); ?></td>
                                <td><?= stripslashes($taskdet['project_description']); ?></td>
                                <?php if ($_SESSION['user_type_id'] == 6 || $_SESSION['user_type_id'] == 5): ?>
                                    <td><?= $taskdet['user_name']; ?></td>
                                <?php else: ?>
                                    <td><?= $taskdet['to_user_name']; ?></td>
                                    <td><?= $taskdet['from_username']; ?></td>
                                <?php endif; ?>
                                <td><?= $taskdet['project_duration']; ?></td>
                                <td><?php echo $prostatus; ?></td>
                                <td>
                                    <?php if ($taskdet['status'] != 6): ?>
                                        <a  class="btn btn-success" href="#EditTask" data-toggle="modal" onclick="edittask(<?php echo $taskdet['id']; ?>)"><i class="fa fa-edit"></i></a>
                                    <?php else: ?>
                                        <a  class="btn btn-primary" href="#EditTask" data-toggle="modal" onclick="edittask(<?php echo $taskdet['id']; ?>)"><i class="fa fa-eye"></i></a>
                                    <?php endif; ?>
                                    <a href="javascript:void(0)" class="btn btn-danger" onclick="delete_actions(<?php echo $taskdet['id']; ?>, 'task_history')"><i class="fa fa-trash"></i></a>
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
            <div class="col-xs-12">
                <a href="javascript:void(0)" class="btn btn-danger" onclick="activate_users('departments', '3')">Delete</a>
            </div>
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

<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $('#projects_table').DataTable();
    });

</script>