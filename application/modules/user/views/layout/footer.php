
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 ticket-footer">
            <h5>Copyright © 2017<span><a href="#" target="_blank"> PMS </a></span>All rights reserved.</h5>
        </div>
    </div>
    <?php
    $day_start = date("d", strtotime("next Sunday")); // get next Sunday
    for ($x = 0; $x < 7; $x++)
        $week_days[] = date("D", mktime(0, 0, 0, date("m"), $day_start + $x, date("y")));
    ?>
</div>
<div class="modal fade" id="Add_Department" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" area-hidden="true">&times;</button>
                <h4 class="modal-title">Add Department</h4>
            </div>
            <div class="modal-body">
                <form name="department_form" id="department_form" method="post" action="<?php echo frontend_url() . 'departments/insert'; ?>" data-parsley-validate="">
                    <input type="hidden" name="department_action" id="department_action" value="add_department"/>

                    <div class="form-group">
                        <label >Name <span style="color:red">*</span></label>
                        <input type="text" name="department_name" id="department_name" tabindex="1" class="form-control" placeholder="Enter Name" value="<?php echo set_value('department_name'); ?>" required="" data-parsley-minlength="3" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label >Status <span style="color:red">*</span></label>
                        <select name="department_status" id="department_status" class="form-control" required="">
                            <option value="">-Select Status-</option>
                            <option value="0">Pending</option>
                            <option value="1">Active</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3 col-sm-offset-3">
                                <input type="submit" name="department_status-submit" id="department_status-submit" tabindex="4" class="form-control btn btn-primary" value="Add">
                            </div>
                            <div class="col-sm-3 ">
                                <input type="reset" name="department_status-reset" id="department_status-reset" tabindex="4" class="form-control btn btn-danger" value="Clear">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var BASE_URL = '<?php echo BASE_URL; ?>';
    var FRONTEND_URL = '<?php echo frontend_url(); ?>';
</script>
<script>
    $(document).ready(function () {
        $(".noteicon").click(function () {
            $(".notificationfixed").show();
            $("#notificationMenu").show();
        });
        $(".notificationfixed").click(function (e) {
            $(".notificationfixed").hide();
            $("#notificationMenu").hide();
        });
    });

</script>
<script>
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>

<script>
    function htmlbodyHeightUpdate() {
        var height3 = $(window).height();
        var height1 = $('.nav').height() + 50;
        height2 = $('.container-main').height();
        if (height2 > height3) {
            $('html').height(Math.max(height1, height3, height2) + 10);
            $('body').height(Math.max(height1, height3, height2) + 10);
        } else
        {
            $('html').height(Math.max(height1, height3, height2));
            $('body').height(Math.max(height1, height3, height2));
        }

    }
    $(document).ready(function () {
        htmlbodyHeightUpdate();
        $(window).resize(function () {
            htmlbodyHeightUpdate();
        });
        $(window).scroll(function () {
            height2 = $('.container-main').height();
            htmlbodyHeightUpdate();
        });
    });</script>
<script>
    $('.update_notification').click(function (e) {

        var id = $(this).attr('id');
        var type = $(this).attr('data-title');
        $.ajax({
            type: "POST",
            url: BASE_URL + 'user/notyupdate',
            data: {id: id},
            success: function (data) {
                if (type == 1) {
                    window.location.href = BASE_URL + 'user/projects';
                } else if (type == 2) {
                    window.location.href = BASE_URL + 'user/tasks/manage_asign_task';
                } else if (type == 3) {
                    window.location.href = BASE_URL + 'user/tasks/manage_new_task';
                } else if (type == 4) {
                    window.location.href = BASE_URL + 'user/tasks/manage_new_task';
                }
            }
        });
    });
</script>