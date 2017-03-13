<div class="col-xs-12">
    <h1>Manage Projects</h1>
    <div class="clear" style="clear: both;height:3em"></div>
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Manage Projects
        </div>
        <div class="panel-body">
            <div class="col-xs-12">
                <a href="javascript:void(0)" class="btn btn-danger" onclick="activate_users('departments', '3')">Delete</a>
            </div>
            <div class="col-xs-12" id="empsucc_message">

            </div>
            <table id="dashboarddetails" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Project Title</th>
                        <th>Project Description</th>
                        <th>Project Type</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($records as $det): ?>
                        <tr>
                            <th><?php echo $det['id']; ?></th>
                            <th><?php echo $det['project_name']; ?></th>
                            <th><?php echo $det['project_description']; ?></th>
                            <th><?php echo $det['projecttype_status']; ?></th>
                            <th><?php echo $det['project_status']; ?></th>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $('#dashboarddetails').DataTable();
    });

</script>