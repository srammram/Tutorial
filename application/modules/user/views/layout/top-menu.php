<div class="col-xs-12">
    <div class="row">
        <div class="top-head">
            <div class="logo">
                <a href="#" style="color: white;font-size:20px;font-weight: bold">PMS</a>
            </div>
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="user-name">
                    <p>Welcome <?php echo get_session_value('user_name'); ?></p>
                    <a href="<?php echo frontend_url() . 'logout'; ?>">Logout</a>
                </div>
            <?php endif; ?>
            <?php if (isset($_SESSION['user_id'])): ?>
            <div class="contain">
            	<?php
				  $notification = get_notification_count();
				  ?>
                <a href="javascript:void(0);" class="notificationicon on"><i class="fa fa-bell fa-2x" aria-hidden="true"></i><span>
                <?php echo count($notification); ?>
                </span></a>
              
                <ul id="notificationMenu" class="notification">
                  
                  <div class="notifbox">
                  <?php
				  foreach($notification as $noty){
				  ?>
                    <li class="notif">
                      <a href="#">
                        <div class="imageblock"> 
                          	<i class="fa fa-bell fa-2x" aria-hidden="true"></i>
                        </div> 
                        <div class="messageblock">
                          <div class="message"><?php echo $noty['message']; ?>
                          </div>
                          <div class="messageinfo">
                            <i class="fa fa-clock-o" aria-hidden="true"></i> 
							<?php
							$time = strtotime($noty['created_on']);
							echo humanTiming($time).' ago'; ?>
                          </div>
                        </div>
                      </a>
                    </li>
                    <?php
				  }
					?>
                  </div>
                  
                </ul>
              </div>
            <?php endif; ?>
        </div>
    </div>
</div>