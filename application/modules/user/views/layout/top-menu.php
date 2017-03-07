<div class="col-xs-12">
    <div class="row">
        <div class="top-head">
            <div class="logo">
                <a href="#" style="color: white;font-size:20px;font-weight: bold">PMS</a>
            </div>
            <div class="user-name">
                <p>Welcome <?php echo get_session_value('user_name'); ?></p>
                <a href="<?php echo frontend_url() . 'logout'; ?>">Logout</a>
            </div>
        </div>
    </div>
</div>