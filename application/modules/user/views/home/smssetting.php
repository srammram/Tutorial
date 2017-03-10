<?php echo $this->load->view('layout/left-menu'); ?>
<div class="col-xs-12">
    <h1>Sms Setting</h1>
    <div class="clear" style="clear: both;height:3em"></div>
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Sms Setting
        </div>
        <div class="panel-body">
            <table id="sms_table" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th><input type="checkbox" name="selectall" id="selectall" value="selectall"/></th>
                        <th>S.No</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($records)):
                        foreach ($records as $smsdetails):
                            if ($smsdetails['status'] == 0):
                                $status = 'Pending';
                            elseif ($smsdetails['status'] == 1):
                                $status = 'Active';
                            else:
                                $status = 'Ignored';
                            endif;
                            ?>
                            <tr>
                                <td><input type="checkbox" class="selectthis" value="<?php echo $smsdetails['id']; ?>"/></td>
                                <td><?= ($smsdetails['id']); ?></td>
                                <td><?= stripslashes($smsdetails['name']); ?></td>
                                <td><?= ($smsdetails['slug']); ?></td>
                                <td><label class="label label-success" style="font-size:12px"><?php echo $status; ?></label></td>
                                <td><a href="<?php echo frontend_url() . 'smssetting/edit/' . encode_value($smsdetails['id']); ?>" class="btn btn-success"><i class="fa fa-edit"></i></a><a href="javascript:void(0)" class="btn btn-danger" onclick="delete_actions(<?php echo $smsdetails['id'] ?>, 'sms_setting')"><i class="fa fa-trash"></i></a></td>
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
        $('#sms_table').DataTable();
    });

</script>