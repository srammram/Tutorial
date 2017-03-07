<?php echo $this->load->view('layout/left-menu'); ?>
<div class="col-xs-12">
    <h1>Manage Departments</h1>
    <div class="clear" style="clear: both;height:3em"></div>
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Manage Departments
        </div>
        <div class="panel-body">
            <table id="departments_table" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th><input type="checkbox" name="selectall" id="selectall" value="selectall"/></th>
                        <th>S.No</th>
                        <th>User Type Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($records)):
                        foreach ($records as $departmentdetails):
                            if ($departmentdetails['status'] == 0):
                                $lableclass = "label label-warning";

                                $status = 'Pending';
                            elseif ($departmentdetails['status'] == 1):
                                $lableclass = "label label-success";
                                $status = 'Active';
                            else:
                                $lableclass = "label label-danger";
                                $status = 'Ignored';
                            endif;
                            ?>
                            <tr>
                                <td><input type="checkbox" class="selectthis" value="<?php echo $departmentdetails['id']; ?>"/></td>
                                <td><?= ($departmentdetails['id']); ?></td>
                                <td><?= stripslashes($departmentdetails['name']); ?></td>
                                <td><label class="<?php echo $lableclass; ?>" style="font-size:12px"><?php echo $status; ?></label></td>
                                <td><a  class="btn btn-success" href="#Editdepartment" data-toggle="modal" onclick="editdepartments(<?php echo $departmentdetails['id']; ?>)"><i class="fa fa-edit"></i></a><a href="javascript:void(0)" class="btn btn-danger" onclick="delete_actions(<?php echo $departmentdetails['id']; ?>, 'departments')"><i class="fa fa-trash"></i></a></td>
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
<div id="Editdepartment" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content" id="departmentsedit">

        </div>
    </div>
</div>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $('#departments_table').DataTable();
    });

</script>