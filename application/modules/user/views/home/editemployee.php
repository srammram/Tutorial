<?php echo $this->load->view('layout/left-menu'); ?>
<div class="col-xs-5">
    <h1>Edit Employee</h1>
</div>
<div class="col-xs-7">
    <div class="clear" style="clear: both;height:2em"></div>

    <a href="<?php echo frontend_url() . 'employee'; ?>" class="btn btn-success" style="float: right">Manage</a>
    <a href="<?php echo frontend_url() . 'employee/add'; ?>" class="btn btn-success " style="float: right">Add</a>
    <div class="clear" style="clear: both;height:2em"></div>
</div>
<div class="col-xs-offset-1 col-xs-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="text-center">Edit Employee</h3>
        </div>
        <div class="panel-body">
            <form name="employee_form" id="employee_form" method="post" action="<?php echo frontend_url() . 'employee/update'; ?>" data-parsley-validate="">
                <div class="form-group">
                    <label >Name <span style="color:red">*</span></label>
                    <input type="text" name="employee_name" id="employee_name" tabindex="1" class="form-control" placeholder="Enter Name" value="<?php echo stripslashes($records[0]['user_name']); ?>"  data-parsley-minlength="3" maxlength="50">
                </div>
                <div class="form-group">
                    <label >Email Address <span style="color:red">*</span></label>
                    <input type="email" name="employee_email" id="employee_email" tabindex="1" class="form-control" placeholder="Enter Email" value="<?php echo $records[0]['user_email']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label >Mobile Number <span style="color:red">*</span></label>
                    <input type="number" name="emp_mobile" id="emp_mobile" tabindex="1" class="form-control" placeholder="Enter Mobile" value="<?php echo $records[0]['user_mobile']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label >Address <span style="color:red">*</span></label>
                    <input type="text" name="emp_address" id="emp_address" tabindex="1" class="form-control" placeholder="Enter Address" value="<?php echo stripslashes($records[0]['user_address']); ?>" required="" data-parsley-minlength="5"  maxlength="50">
                </div>


                <div class="form-group">
                    <label>User Type <span style="color:red">*</span></label>
                    <select name="user_type" id="user_type" class="form-control" required>
                        <option value="">-Select User Type-</option>
                        <?php foreach ($usertype_details as $utype): ?>
                            <option value="<?= $utype['id'] ?>" <?php
                            if (isset($records[0]['user_type_id'])) {
                                if ($records[0]['user_type_id'] == $utype['id']) {
                                    echo "selected";
                                }
                            }
                            ?>><?= ucwords($utype['type_name']); ?></option>
                                    <?php
                                endforeach;
                                ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Departments <span style="color:red">*</span></label>
                    <?php
                    $department_id = explode(',', $records[0]['user_departments_id']);
                    ?>
                    <select name="emp_departments[]" id="emp_departments" class="form-control" required multiple="">
                        <option value="">-Select Department-</option>
                        <?php foreach ($department_details as $dept): ?>
                            <option value="<?= $dept['id'] ?>" <?php
                            if (isset($records[0]['user_departments_id'])) {
                                if (in_array($dept['id'], $department_id)) {
                                    echo "selected";
                                }
                            }
                            ?>><?= ucwords($dept['name']); ?></option>
                                    <?php
                                endforeach;
                                ?>
                    </select>
                </div>
                <div class="form-group">
                    <label >DOB<span style="color:red">*</span></label>
                    <input type="text" name="employee_dob" id="employee_dob" tabindex="1" class="form-control" placeholder="choose your dob" value="<?php echo ($records[0]['user_dob']); ?>" required="" >
                </div>
                <div class="form-group">
                    <label>Country <span style="color:red">*</span></label>
                    <select name="emp_country" id="emp_country" class="form-control" required onchange="get_state_by_country_id(this.value)">
                        <option value="">-Select Country-</option>
                        <?php foreach ($country_details as $coun): ?>
                            <option value="<?= $coun['id'] ?>" <?php
                            if (isset($records[0]['user_country'])) {
                                if ($records[0]['user_country'] == $coun['id']) {
                                    echo "selected";
                                }
                            }
                            ?>><?= ucwords($coun['title']); ?></option>
                                    <?php
                                endforeach;
                                ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Select State <span style="color:red">*</span></label>
                    <select name="emp_state" id="emp_state" class="form-control" required onchange="get_city_by_state_id(this.value)">
                        <option value="">-Select State-</option>
                        <?php foreach ($state_details as $state): ?>
                            <option value="<?php echo $state['id']; ?>" <?php
                            if (isset($records[0]['user_state'])) {
                                if ($records[0]['user_state'] == $state['id']) {
                                    echo "selected";
                                }
                            }
                            ?>><?php echo $state['name']; ?></option>
                                    <?php
                                endforeach;
                                ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Select City <span style="color:red">*</span></label>
                    <select name="emp_city" id="emp_city" class="form-control" required>
                        <option value="">-Select City-</option>
                        <?php foreach ($city_details as $city): ?>
                            <option value="<?php echo $city['id']; ?>" <?php
                            if (isset($records[0]['user_city'])) {
                                if ($records[0]['user_city'] == $city['id']) {
                                    echo "selected";
                                }
                            }
                            ?>><?php echo $city['name']; ?></option>
                                    <?php
                                endforeach;
                                ?>
                    </select>
                </div>
                <?php
				$empmain = left_menus();
				?>
                <div class="form-group">
                    <label>Select Option <span style="color:red">*</span></label>
                    <select name="emp_accessmenu[]" multiple="multiple" id="emp_accessmenu" class="form-control" required>

                        <?php 
						$menudetails = explode(',', $records[0]['user_access_menus_id']);
						foreach ($empmain['menus'] as $accessmenus): ?>
                        
                            <option value="<?php echo $accessmenus['id']; ?>" <?php
                            if (in_array($accessmenus['id'], $menudetails)): echo "selected";
                            endif;
                            ?>><?php echo $accessmenus['name']; ?></option>
                            
                            <?php
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-sm-offset-3">
                            <input type="hidden" name="emp_id" id="emp_id" value="<?php echo $records[0]['id']; ?>"/>
                            <input type="submit" name="employee-edit" id="employee-edit" tabindex="4" class="form-control btn btn-primary" value="Update">
                        </div>
                        <div class="col-sm-3 ">
                            <input type="reset" name="employee-submit" id="employee-submit" tabindex="4" class="form-control btn btn-danger" value="Clear">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    $('#employee_dob').datepicker({
        dateFormat: 'yy-mm-dd',
        autoclose: true,
    });
    $(function () {
        return $('#emp_state,#emp_city').select2(
                /*{
                 minimumResultsForSearch: Infinity
                 }*/
                );

    });
</script>
