<?php echo $this->load->view('layout/left-menu'); ?>
<div class="col-xs-12">
    <h1>Manage Dependency</h1>
    <div class="clear" style="clear: both;height:3em"></div>
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Manage Dependency
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
                        <th>Dependency Team</th>
                        <th>Set Datetime</th>
                        <th>Unset Datetime</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $user_id = $_SESSION['user_id'];
                    foreach ($records as $manage_dependency):
                        if ($manage_dependency['dependency_status'] == 'Active'):
                            $labelclass = "label label-primary";
                        elseif ($manage_dependency['dependency_status'] == 'Set'):
                            $labelclass = "label label-success";
                        elseif ($manage_dependency['dependency_status'] == 'Unset'):
                            $labelclass = "label label-warning";
                        else:
                            $labelclass = "label label-danger";
                        endif;
                        ?>
                        <tr>
                            <td><input type="checkbox" class="selectthis" value="<?php echo $manage_dependency['id']; ?>"/></td>
                            <td><?php echo $manage_dependency['id']; ?></td>
                            <td><?php echo $manage_dependency['project_name']; ?></td>
                            <td><?php echo $manage_dependency['task_title']; ?></td>
                            <td><?php echo $manage_dependency['department_name']; ?></td>
                            <td><?php echo $manage_dependency['set_datetime']; ?></td>
                            <td><?php echo $manage_dependency['unset_datetime'] != 0 ? $manage_dependency['unset_datetime'] : 'N/A'; ?></td>
                            <td><label class="<?php echo $labelclass; ?>"><?php echo $manage_dependency['dependency_status']; ?></label></td>
                            <td>
                                <?php if ($manage_dependency['to_user_id'] == $user_id): ?>
                                    <a href="#EditDependency" data-toggle="modal" onclick="edit_dependency(<?php echo $manage_dependency['id']; ?>);" class="btn btn-success"><i class="fa fa-pencil-square-o"></i></a>
                                <?php endif; ?>
                                <a href="#ViewDependency" data-toggle="modal" onclick="view_dependency(<?php echo $manage_dependency['id']; ?>);" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                <?php if ($manage_dependency['created_at'] == $user_id && $manage_dependency['dependency_status'] == 'Unset'): ?>
                                    <a href="#ReasignDependency" data-toggle="modal" onclick="reasign_dependency(<?php echo $manage_dependency['id']; ?>);" class="btn btn-primary" title="Re Asign"><i class="fa fa-tasks"></i></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
</div>
<div id="ViewDependency" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content" id="view_dependency">

        </div>
    </div>
</div>
<div id="EditDependency" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content" id="edit_dependency">

        </div>
    </div>
</div>
<div id="ReasignDependency" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content" id="reasign_dependency">

        </div>
    </div>
</div>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $('#manage_new_tasks').DataTable();
    });

</script>