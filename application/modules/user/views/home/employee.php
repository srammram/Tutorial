<?php echo $this->load->view('layout/left-menu'); ?>
<div class="col-xs-12">
    <div class="col-xs-5">
        <h1>Manage Employee</h1>
    </div>
    <div class="col-xs-7">
        <div class="clear" style="clear: both;height:2em"></div>
        <a href="<?php echo frontend_url() . 'employee/add'; ?>" class="btn btn-success " style="float: right">Add</a>
        <div class="clear" style="clear: both;height:2em"></div>
    </div>
    <div class="clear" style="clear: both;height:3em"></div>
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Manage Employees
        </div>
        <div class="panel-body">
            <div class="col-xs-12">
                <a href="javascript:void(0)" class="btn btn-success" onclick="activate_users('users', '1')">Activate</a>
                <a href="javascript:void(0)" class="btn btn-warning" onclick="activate_users('users', '0')">Deactivate</a>
                <a href="javascript:void(0)" class="btn btn-danger" onclick="activate_users('users', '2')">Delete</a>
            </div>
            <div class="col-xs-12" id="empsucc_message">

            </div>
            <div class="clear" style="clear:both;height:1em"></div>
            <table id="user_type_table" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th><input type="checkbox" name="selectall" id="selectall" value="selectall"/></th>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>User Type</th>
                        <th>Departments</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($records)):
                        foreach ($records as $employeedetails):
                            if ($employeedetails['status'] == 0):
                                $lableclass = "label label-warning";
                                $status = 'Pending';
                            elseif ($employeedetails['status'] == 1):
                                $lableclass = "label label-success";
                                $status = 'Active';
                            else:
                                $lableclass = "label label-danger";
                                $status = 'Ignored';
                            endif;
                            ?>
                            <tr>
                                <td><input type="checkbox" class="selectthis" name="empcheckid" value="<?php echo $employeedetails['id']; ?>"/></td>
                                <td><?= ($employeedetails['id']); ?></td>
                                <td><?= stripslashes($employeedetails['user_name']); ?></td>
                                <td><?= stripslashes($employeedetails['user_email']); ?></td>
                                <td><?= stripslashes($employeedetails['user_mobile']); ?></td>
                                <td><?= stripslashes($employeedetails['usertype_name']); ?></td>
                                <td><?= stripslashes($employeedetails['department_name']); ?></td>
                                <td><label class="<?php echo $lableclass; ?>" style="font-size:12px"><?php echo $status; ?></label></td>
                                <td><a href="<?php echo frontend_url() . 'employee/edit/' . encode_value($employeedetails['id']); ?>" class="btn btn-success"><i class="fa fa-edit"></i></a><a href="javascript:void(0)" class="btn btn-danger" onclick="delete_actions(<?php echo $employeedetails['id'] ?>, 'users')"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <?php
                        endforeach;
                    else:
                        echo "No Records Found";
                    endif;
                    ?>
                </tbody>
            </table>
            <div class="clear" style="clear:both;height:1em"></div>
            <div class="col-xs-12">
                <a href="javascript:void(0)" class="btn btn-success" onclick="activate_users('users', '1')">Activate</a>
                <a href="javascript:void(0)" class="btn btn-warning" onclick="activate_users('users', '0')">Deactivate</a>
                <a href="javascript:void(0)" class="btn btn-danger" onclick="activate_users('users', '2')">Delete</a>
            </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $('#user_type_table').DataTable();
    });

</script>