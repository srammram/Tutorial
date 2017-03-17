<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=exceldata.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<table id="reports_table" class="display" cellspacing="0" width="100%">
    <thead>
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
    </thead>
    <tbody >
        <?php foreach ($records as $details): ?>
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
        <?php endforeach; ?>
    </tbody>
</table>