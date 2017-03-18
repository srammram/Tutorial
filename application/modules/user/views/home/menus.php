<?php echo $this->load->view('layout/left-menu'); ?>
<div class="col-xs-12">
    <h1>Manage Menus</h1>
    <div class="clear" style="clear: both;height:3em"></div>
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Manage Menus
        </div>
        <div class="panel-body">
            <div class="col-xs-12">
                <a href="javascript:void(0)" class="btn btn-danger" onclick="activate_users('menus', '3')">Delete</a>
            </div>
            <div class="col-xs-12" id="empsucc_message">

            </div>
            <table id="departments_table" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th><input type="checkbox" name="selectall" id="selectall" value="selectall"/></th>
                        <th>S.No</th>
                        <th>Menus</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($records)):
                        foreach ($records as $menudetails):
                            if ($menudetails['status'] == 0):
                                $lableclass = "label label-warning";

                                $status = 'Pending';
                            elseif ($menudetails['status'] == 1):
                                $lableclass = "label label-success";
                                $status = 'Active';
                            else:
                                $lableclass = "label label-danger";
                                $status = 'Ignored';
                            endif;
                            ?>
                            <tr>
                                <td><input type="checkbox" class="selectthis" value="<?php echo $menudetails['id']; ?>"/></td>
                                <td><?= ($menudetails['id']); ?></td>
                                <td><?= stripslashes($menudetails['name']); ?></td>
                                <td><label class="<?php echo $lableclass; ?>" style="font-size:12px"><?php echo $status; ?></label></td>
                                <td><a  class="btn btn-success" href="#Editmenu" data-toggle="modal" onclick="editmenu(<?php echo $menudetails['id']; ?>)"><i class="fa fa-edit"></i></a><a href="javascript:void(0)" class="btn btn-danger" onclick="delete_actions(<?php echo $menudetails['id']; ?>, 'menus')"><i class="fa fa-trash"></i></a><a  class="btn btn-warning" href="<?php echo frontend_url().'menus/view/'.encode_value($menudetails['id']); ?>" ><i class="fa fa-list"></i></a></td>
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
                <a href="javascript:void(0)" class="btn btn-danger" onclick="activate_users('menus', '3')">Delete</a>
            </div>
        </div>
    </div>
</div>
</div>
<div id="Editmenu" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content" id="menuedit">

        </div>
    </div>
</div>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $('#departments_table').DataTable();
    });

</script>