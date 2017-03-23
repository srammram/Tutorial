<?php echo $this->load->view('layout/left-menu'); ?>
<div class="col-xs-12">
    <h1>Manage Remainder</h1>
    <div class="clear" style="clear: both;height:3em"></div>
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Manage Remainder
        </div>
        <div class="panel-body">
            <div class="col-xs-12">
                <a href="javascript:void(0)" class="btn btn-danger" onclick="activate_users('remainder', '3')">Delete</a>
            </div>
            <div class="col-xs-12" id="empsucc_message">

            </div>
            <table id="departments_table" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th><input type="checkbox" name="selectall" id="selectall" value="selectall"/></th>
                        <th>S.No</th>
                        <th>remainder Date</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($records)):
                        foreach ($records as $remainderdetails):
                            if ($remainderdetails['status'] == 0):
                                $lableclass = "label label-warning";

                                $status = 'Pending';
                            elseif ($remainderdetails['status'] == 1):
                                $lableclass = "label label-success";
                                $status = 'Active';
                            else:
                                $lableclass = "label label-danger";
                                $status = 'Ignored';
                            endif;
                            ?>
                            <tr>
                                <td><input type="checkbox" class="selectthis" value="<?php echo $remainderdetails['id']; ?>"/></td>
                                <td><?= ($remainderdetails['id']); ?></td>
                                <td><?= stripslashes($remainderdetails['remain_date']); ?></td>
                                <td><?= stripslashes($remainderdetails['title']); ?></td>
                                <td><?= stripslashes($remainderdetails['description']); ?></td>
                                <td><label class="<?php echo $lableclass; ?>" style="font-size:12px"><?php echo $status; ?></label></td>
                                <td><a  class="btn btn-success" href="#Editremainder" data-toggle="modal" onclick="editremainder(<?php echo $remainderdetails['id']; ?>)"><i class="fa fa-edit"></i></a><a href="javascript:void(0)" class="btn btn-danger" onclick="delete_actions(<?php echo $remainderdetails['id']; ?>, 'remainder')"><i class="fa fa-trash"></i></a></td>
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
                <a href="javascript:void(0)" class="btn btn-danger" onclick="activate_users('remainder', '3')">Delete</a>
            </div>
        </div>
    </div>
</div>
</div>
<div id="Editremainder" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content" id="remainderedit">

        </div>
    </div>
</div>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $('#departments_table').DataTable();
    });

</script>