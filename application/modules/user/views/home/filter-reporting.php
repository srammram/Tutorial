<table id="reports_table" class="display" cellspacing="0" width="100%">

    <thead>
        <?php if ($action == 'not_employee'): ?>
            <tr>
                <th>S.No</th>
                <th>Project Title</th>
                <th>Project Description</th>
                <th>Project Type</th>
                <th>Estimated Hours</th>
                <th>Assigning Team</th>
                <th>Team Leaders</th>
                <!--<th>Team Members</th>-->
                <th>Status</th>

            </tr>
        <?php else: ?>
            <tr>
                <th>S.No</th>
                <th>Project Title</th>
                <th>Task Title</th>
                <th>Message</th>
                <th>Estimated Hours</th>
                <th>Used Hours</th>
                <th>Assigned From</th>
                <th>Name</th>
                <!--<th>Team Members</th>-->
                <th>Status</th>

            </tr>
        <?php endif; ?>
    </thead>
    <tbody id="reporting_body">
        <?php if ($action == 'not_employee'): ?>
            <?php
            foreach ($records as $details):
                ?>
                <tr>
                    <td><?php echo $details['id']; ?></td>
                    <td><?php echo $details['project_name']; ?></td>
                    <td><?php echo $details['project_description']; ?></td>
                    <td><?php echo $details['type_status']; ?></td>
                    <td><?php echo $details['project_during_hours'] . ' Hours'; ?></td>
                    <td><?php echo $details['department_name']; ?></td>
                    <td><?php echo implode(' , ', $team_leaders[$details['id']]) ?></td>
                    <!--<td><?php echo implode(',', array_filter($team_members[$details['id']])); ?></td>-->
                    <td><?php echo $details['project_status']; ?></td>

                </tr>
                <?php
            endforeach;
            ?>


        <?php else: ?>
            <?php
            foreach ($records as $details):
                ?>
                <tr>
                    <td><?php echo $details['task_id']; ?></td>
                    <td><?php echo $details['project_name']; ?></td>
                    <td><?php echo $details['task_title']; ?></td>
                    <td><?php echo $details['message']; ?></td>
                    <td><?php echo $details['project_duration']; ?></td>
                    <td><?php echo $details['finished_duration_hours']; ?></td>
                    <td><?php echo $details['asgined_from']; ?></td>
                    <td><?php echo $details['asigned_to']; ?></td>
                    <td><?php echo $details['task_status']; ?></td>
                </tr>
                <?php
            endforeach;
        endif;
        ?>
    </tbody>
</table>
<script type="text/javascript" >
    $(document).ready(function () {
        $('#reports_table').DataTable();
    });

</script>