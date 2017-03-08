<?php echo $this->load->view('layout/left-menu'); ?>
<div class="col-xs-12">
    <h1>Manage User Type</h1>
    <div class="clear" style="clear: both;height:3em"></div>
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Manage User Type
        </div>
        <div class="panel-body">

            <table id="user_type_table" class="display" cellspacing="0" width="100%">
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
                        foreach ($records as $usertypedetails):
                            if ($usertypedetails['status'] == 0):
                                $lableclass = "label label-warning";
                                $status = 'Pending';
                            elseif ($usertypedetails['status'] == 1):
                                $lableclass = "label label-success";
                                $status = 'Active';
                            else:
                                $lableclass = "label label-danger";
                                $status = 'Ignored';
                            endif;
                            ?>
                            <tr>
                                <td><input type="checkbox" class="selectthis" value="<?php echo $usertypedetails['id']; ?>"/></td>
                                <td><?= ($usertypedetails['id']); ?></td>
                                <td><?= stripslashes($usertypedetails['type_name']); ?></td>
                                <td><label class="<?php echo $lableclass; ?>" style="font-size:12px"><?php echo $status; ?></label></td>
                                <td><a class="btn btn-success" href="#Editusertype" data-toggle="modal" onclick="editusertype(<?php echo $usertypedetails['id']; ?>)"><i class="fa fa-edit"></i></a><a href="javascript:void(0)" class="btn btn-danger" onclick="delete_actions(<?php echo $usertypedetails['id'] ?>, 'user_type')"><i class="fa fa-trash"></i></a></td>
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
                <a class="btn btn-danger" >Delete</a>
            </div>
        </div>
    </div>
</div>
</div>
<div id="Editusertype" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content" id="useredit">

        </div>
    </div>
</div>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $('#user_type_table').DataTable();
    });

</script>