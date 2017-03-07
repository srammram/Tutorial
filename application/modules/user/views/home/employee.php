<?php echo $this->load->view('layout/left-menu'); ?>
<div class="col-xs-12">
    <h1>Manage Employees</h1>
    <div class="clear" style="clear: both;height:3em"></div>
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Manage Employees
        </div>
        <div class="panel-body">
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
                                $status = 'Pending';
                            elseif ($employeedetails['status'] == 1):
                                $status = 'Active';
                            else:
                                $status = 'Ignored';
                            endif;
                            ?>
                            <tr>
                                <td><input type="checkbox" class="selectthis" value="<?php echo $employeedetails['id']; ?>"/></td>
                                <td><?= ($employeedetails['id']); ?></td>
                                <td><?= stripslashes($employeedetails['user_name']); ?></td>
                                <td><?= stripslashes($employeedetails['user_email']); ?></td>
                                <td><?= stripslashes($employeedetails['user_mobile']); ?></td>
                                <td><?= stripslashes($employeedetails['usertype_name']); ?></td>
                                <td><?= stripslashes($employeedetails['department_name']); ?></td>
                                <td><label class="label label-success" style="font-size:12px"><?php echo $status; ?></label></td>
                                <td><a href="javascript:void(0)" class="btn btn-success"><i class="fa fa-edit"></i></a><a href="javascript:void(0)" class="btn btn-danger" onclick="delete_actions(<?php echo $employeedetails['id'] ?>, 'users')"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <?php
                        endforeach;
                    else:
                        echo "No Records Found";
                    endif;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $('#user_type_table').DataTable();
    });

</script>