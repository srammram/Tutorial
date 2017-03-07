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
                                $status = 'Pending';
                            elseif ($usertypedetails['status'] == 1):
                                $status = 'Active';
                            else:
                                $status = 'Ignored';
                            endif;
                            ?>
                            <tr>
                                <td><input type="checkbox" class="selectthis" value="<?php echo $usertypedetails['id']; ?>"/></td>
                                <td><?= ($usertypedetails['id']); ?></td>
                                <td><?= stripslashes($usertypedetails['type_name']); ?></td>
                                <td><label class="label label-success" style="font-size:12px"><?php echo $status; ?></label></td>
                                <td><a href="javascript:void(0)" class="btn btn-success"><i class="fa fa-edit"></i></a><a href="javascript:void(0)" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
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