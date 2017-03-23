<?php echo $this->load->view('layout/left-menu'); ?>

<h1>Profile Edit</h1>
<div class="col-xs-offset-2 col-xs-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="text-center">Profile Edit</h3>
        </div>
        <div class="panel-body">
            <form name="profile_form" id="profile_form" method="post" action="<?php echo frontend_url() . 'profile/update'; ?>" data-parsley-validate="">
                <div class="form-group">
                    <label >Name <span style="color:red">*</span></label>
                    <input type="text" name="user_name" id="user_name" tabindex="1" class="form-control" placeholder="Enter Name" value="<?php echo isset($user['user_name']) ? $user['user_name'] : ''; ?>" required="" data-parsley-minlength="3" maxlength="50">
                </div>
                
                
                <div class="form-group">
                    <label >Address <span style="color:red">*</span></label>
                    <input type="text" name="user_address" id="user_address" tabindex="1" class="form-control" placeholder="Enter Address" value="<?php echo isset($user['user_address']) ? $user['user_address'] : ''; ?>" required="" data-parsley-minlength="5"  maxlength="250">
                </div>


                
                <div class="form-group">
                    <label >DOB<span style="color:red">*</span></label>
                    <input type="text" name="user_dob" id="user_dob" tabindex="1" class="form-control" placeholder="choose your dob" value="<?php echo isset($user['user_dob']) ? $user['user_dob'] : ''; ?>" required="" >
                </div>
                <div class="form-group">
                    <label>Country <span style="color:red">*</span></label>
                    <select name="user_country" id="emp_country" class="form-control" required onchange="get_state_by_country_id(this.value)">
                        <option value="">-Select Country-</option>
                        <?php foreach ($countries as $coun): ?>
                            <option value="<?= $coun['id'] ?>" <?php
                            if (isset($user['user_country'])) {
                                if ($user['user_country'] == $coun['id']) {
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
                    <select name="user_state" id="emp_state" class="form-control" required onchange="get_city_by_state_id(this.value)">
                        <option value="">-Select State-</option>
						<?php foreach ($states as $sta): ?>
                            <option value="<?= $sta['id'] ?>" <?php
                            if (isset($user['user_state'])) {
                                if ($user['user_state'] == $sta['id']) {
                                    echo "selected";
                                }
                            }
                            ?>><?= ucwords($sta['name']); ?></option>
                                    <?php
                                endforeach;
                                ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Select City <span style="color:red">*</span></label>
                    <select name="user_city" id="emp_city" class="form-control" required>
                        <option value="">-Select City-</option>
						<?php foreach ($cities as $cit): ?>
                            <option value="<?= $cit['id'] ?>" <?php
                            if (isset($user['user_city'])) {
                                if ($user['user_city'] == $cit['id']) {
                                    echo "selected";
                                }
                            }
                            ?>><?= ucwords($cit['name']); ?></option>
                                    <?php
                                endforeach;
                                ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-3 col-sm-offset-3">
                            <input type="submit" name="profile-submit" id="profile-submit" tabindex="4" class="form-control btn btn-primary" value="Update">
                        </div>
                        <div class="col-sm-3 ">
                            <input type="reset" name="profile-reset" id="profile-reset" tabindex="4" class="form-control btn btn-danger" value="Clear">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    $('#user_dob').datepicker({
        dateFormat: 'yy-mm-dd',
        autoclose: true,
    });
</script>

