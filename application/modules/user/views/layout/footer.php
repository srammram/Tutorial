
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
<script type="text/javascript">
    var BASE_URL = '<?php echo BASE_URL; ?>';
    var FRONTEND_URL = '<?php echo frontend_url(); ?>';
</script>
<script>
    $(document).ready(function () {
        $(".notificationicon").click(function () {
            $(this).toggleClass("open");
            $("#notificationMenu").toggleClass("open");
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