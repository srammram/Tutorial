<?php echo $this->load->view('layout/left-menu'); ?>
<div class="col-xs-12">
    <h1>Reports</h1>
    <div class="clear" style="clear: both;height:3em"></div>
    <div class="panel panel-default">
        <div class="panel-heading text-center">
            Reports
        </div>
        <div class="panel-body">
            <div class="col-xs-12">
                <form name="filter_form" id="filter_form" action="post">
                    <input type="hidden" name="report_action" id="report_action" value="filter values"/>
                    <div class="col-xs-3">
                        <select name="select_project" id="select_project" class="form-control">
                            <option value="">-Select Option-</option>
                            <?php
                            foreach ($project_details as $details):
                                ?>
                                <option value="<?php echo $details['id'] ?>"><?php echo $details['project_name']; ?></option>
                                <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="col-xs-3">
                        <select name="select_departments" id="select_departments"  class="form-control" onchange="getemployees(this.value)">
                            <option value="">-Select Departments-</option>
                            <?php
                            foreach ($department_details as $details):
                                ?>
                                <option value="<?php echo $details['id']; ?>"><?php echo $details['name']; ?></option>
                                <?php
                            endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="col-xs-3">
                        <select name="select_employee" id="select_employee" class="form-control" >
                            <option value="">-Select Employee-</option>
                        </select>
                    </div>
                    <div class="col-xs-3">
                        <input type="text" name="start_date" id="start_date" class="form-control" placeholder="Choose Start Date"/>
                    </div>
                    <div class="clear" style="clear: both;height:0.5em"></div>
                    <div class="col-xs-3">
                        <input type="text" name="end_date" id="end_date" class="form-control" placeholder="Choose End Date"/>
                    </div>
                    <div class="col-xs-5">
                        <input type="button" name="filter_report" id="filter_report" class="btn btn-primary" value="Get Reports" onclick="get_filter_reports()"/>
                        <a href="<?php echo frontend_url() . 'export_excel' ?>" class="btn btn-primary">Export Excel</a>
                    </div>
                </form>
            </div>
        </div>
        <div class="clear" style="clear: both;height:2em"></div>
        <div id="reporting_table">
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
        </div>
    </div>
</div>
</div>
</div>
<div id="EditProject" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content" id="projectsedit">

        </div>
    </div>
</div>
<div id="AssignProject" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content" id="asignproject">

        </div>
    </div>
</div>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function () {
        $('#reports_table').DataTable();
    });
    $(function () {
        $('#start_date').datetimepicker({
            useCurrent: false,
        });
        $('#end_date').datetimepicker({
            useCurrent: false,
        });
        $("#start_date").on("dp.change", function (e) {
            $('#end_date').data("DateTimePicker").minDate(e.date);
        });
    });
</script>