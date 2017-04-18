<?php
if ($department_details != ''):
    ?>

    <div class="form-group">
        <label>Select Departments <span style="color:red">*</span></label>
        <select name="asign_user_departments" id="asign_user_departments" class="form-control" required="" onchange="get_employee_details(this.value);getavailable(this.value)">
            <option value="">-Select Departments</option>
            <?php
            foreach ($department_details as $details):
                ?>
                <option value="<?php echo $details['id'] ?>"><?php echo $details['name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div id="get_department_by_employee">

    </div>
<?php endif; ?>
<input type="hidden" name="project_type_status" id="project_type_status" value="<?php echo $project_type_status; ?>"/>
<?php
if ($department_details == ''):
    ?>
    <div class="form-group">
        <label>Select Employee <span style="color:red">*</span></label>
        <select name="asign_user_details" id="asign_user_details" class="form-control" required="">
            <option value="">-Select Employee</option>
            <?php
            foreach ($records as $details):
                ?>
                <option value="<?php echo $details['id'] ?>"><?php echo $details['user_name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
<?php endif; ?>
<script type="text/javascript">

    $('#asign_user_details,#asign_user_departments').select2(
            /*{
             minimumResultsForSearch: Infinity
             }*/
            );

</script>
