<?php echo $this->load->view('layout/left-menu'); ?>

<h1>Add Employee</h1>
<div class="col-xs-offset-2 col-xs-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="text-center">Add Employee</h3>
        </div>
        <div class="panel-body">
            <form name="employee_form" id="employee_form" method="post" action="<?php echo frontend_url() . 'employee/insert'; ?>" data-parsley-validate="">
                <div class="form-group">
                    <label >Name <span style="color:red">*</span></label>
                    <input type="text" name="employee_name" id="employee_name" tabindex="1" class="form-control" placeholder="Enter Name" value="<?php echo isset($_SESSION['employee_name']) ? $_SESSION['employee_name'] : ''; ?>" required="" data-parsley-minlength="3" maxlength="50">
                </div>
                <div class="form-group">
                    <label >Email Address <span style="color:red">*</span></label>
                    <input type="email" name="employee_email" id="employee_email" tabindex="1" class="form-control" placeholder="Enter Email" value="<?php echo isset($_SESSION['employee_email']) ? $_SESSION['employee_email'] : ''; ?>" required="" data-parsley-type="email">
                </div>
                <div class="form-group">
                    <label >Password <span style="color:red">*</span></label>
                    <input type="password" name="employee_pass" id="employee_pass" tabindex="1" class="form-control" placeholder="Enter Password" value="" required="" data-parsley-minlength="6" maxlength="50">
                </div>
                <div class="form-group">
                    <label >Confirm Password <span style="color:red">*</span></label>
                    <input type="password" name="employee_repass" id="employee_repass" tabindex="1" class="form-control" placeholder="Enter Confirm Password" value="" required="" data-parsley-minlength="6" data-parsley-equalto="#employee_pass" maxlength="50">
                </div>
                <div class="form-group">
                    <label >Mobile Number <span style="color:red">*</span></label>
                    <input type="number" name="emp_mobile" id="emp_mobile" tabindex="1" class="form-control" placeholder="Enter Mobile" value="<?php echo isset($_SESSION['emp_mobile']) ? $_SESSION['emp_mobile'] : ''; ?>" required="" data-parsley-type="number"  data-parsley-minlength="10"   maxlength="50">
                </div>
                <div class="form-group">
                    <label >Address <span style="color:red">*</span></label>
                    <input type="text" name="emp_address" id="emp_address" tabindex="1" class="form-control" placeholder="Enter Address" value="<?php echo isset($_SESSION['emp_address']) ? $_SESSION['emp_address'] : ''; ?>" required="" data-parsley-minlength="5"  maxlength="500">
                </div>

                <div class="form-group">
                    <label>Departments <span style="color:red">*</span></label>
                    <select name="emp_departments[]" id="emp_departments" multiple=""  class="form-control" required="">
                        <option value="">-Select Department-</option>
                        <?php foreach ($departments as $dept): ?>
                            <option value="<?= $dept['id'] ?>" <?php
                            if (isset($_SESSION['emp_departments'])) {
                                if ($_SESSION['emp_departments'] == $dept['id']) {
                                    echo "selected";
                                }
                            }
                            ?>><?= ucwords($dept['name']); ?></option>
                                    <?php
                                endforeach;
                                ?>
                        <option value="add_department">Add Department</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>User Type <span style="color:red">*</span></label>
                    <select name="user_type" id="user_type" class="form-control" required="" onchange="get_reporting_person(this.value)">
                        <option value="">-Select User Type-</option>
                        <?php foreach ($usertype as $utype): ?>
                            <option value="<?= $utype['id'] ?>" <?php
                            if (isset($_SESSION['user_type'])) {
                                if ($_SESSION['user_type'] == $utype['id']) {
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
                    <label>Reporting Person</label>
                    <select name="reporting_person" id="reporting_person" class="form-control" required="">
                        <option value="">-Select Person-</option>
                    </select>
                </div>

                <div class="form-group">
                    <label >DOB<span style="color:red">*</span></label>
                    <input type="text" name="employee_dob" id="employee_dob" tabindex="1" class="form-control" placeholder="choose your dob" value="<?php echo isset($_SESSION['employee_dob']) ? $_SESSION['employee_dob'] : ''; ?>" required="" >
                </div>
                <div class="form-group">
                    <label>Country <span style="color:red">*</span></label>
                    <select name="emp_country" id="emp_country" class="form-control" required="" onchange="get_state_by_country_id(this.value)">
                        <option value="">-Select Country-</option>
                        <?php foreach ($countries as $coun): ?>
                            <option value="<?= $coun['id'] ?>" <?php
                            if (isset($_SESSION['emp_country'])) {
                                if ($_SESSION['emp_country'] == $coun['id']) {
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
                    <select name="emp_state" id="emp_state" class="form-control" required="" onchange="get_city_by_state_id(this.value)">
                        <option value="">-Select State-</option>

                    </select>
                </div>
                <div class="form-group">
                    <label>Select City <span style="color:red">*</span></label>
                    <select name="emp_city" id="emp_city" class="form-control" required="">
                        <option value="">-Select City-</option>

                    </select>
                </div>
                <div class="form-group">
                    <label>Select Option <span style="color:red">*</span></label>
                    <select name="emp_accessmenu[]" multiple="multiple" id="emp_accessmenu" class="form-control" required="">

                        <?php foreach ($leftmenus as $menus): ?>
                            <option value="<?php echo $menus['id']; ?>"><?php echo $menus['menu_name']; ?></option>
                            <?php
                        endforeach;
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-sm-offset-3">
                            <input type="submit" name="employee-submit" id="employee-submit" tabindex="4" class="form-control btn btn-primary" value="Add">
                        </div>
                        <div class="col-sm-3 ">
                            <input type="reset" name="employee-reset" id="employee-reset" tabindex="4" class="form-control btn btn-danger" value="Clear">
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
        format: 'yyyy-mm-dd',
        autoclose: true,
    });
</script>
