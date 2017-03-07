
<footer>
			<div class="row">
				<div class="col-lg-9 col-md-7 col-sm-12 col-xs-12 footer_section1">
					<?php echo $blocks['site_footer']; ?>
                    <div class="row footer-2">
                        <div class="col-sm-3 hidden-xs"><a href="" class="footlogo">Elect TV</a></div>
                        <div class="col-sm-4">
                            <div class="tag-cloud hidden-xs">
                                <?php
                                for($j=0; $j<count($category_name); $j++){
                                ?>
                                <a href="<?php echo frontend_url('newslist/'.$category_name[$j]['slug']); ?>"><?php echo $category_name[$j]['name']; ?></a>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="social-media">
                                <a href="" class="f-facebook"></a>
                                <a href="" class="f-twitter"></a>
                                <a href="" class="f-googleplus"></a>
                                <a href="" class="f-linkedin"></a>
                                <a href="" class="f-rss"></a>
                                <a href="" class="f-youtube"></a>
                            </div>
                            <p class="copy">&copy; 2017 Elect Tv. All rights reserved.</p>
                        </div>
                        <div class="col-sm-5">
                            <nav class="footer-menu">
                                <ul>
                                    <?php  echo strip_tags($blocks['cms_menu'], '<li><a><ul>'); ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                   
				<div class="col-lg-3 col-md-5 col-sm-7 col-xs-12 footer_section2">
					<h3>Send Us Some Electronic Mail</h3>
                    
					<form id="feedback_form" name="feedback_form" method="post" class="contact-form">
                    	<p class="feedback_status"></p>
						<div class="form-group">
							<label>Your Name:</label>
							<input type="text" id="feedback_name" name="feedback_name" class="txtinput" />
						</div>
						<div class="form-group">
							<label>Company:</label>
							<input type="text" id="feedback_company" name="feedback_company" class="txtinput" />
						</div>
						<div class="form-group">
							<label>Email Address:</label>
							<input type="email" id="feedback_email" name="feedback_email" class="txtinput" />
						</div>
						<div class="form-group">
							<label>Phone Number:</label>
							<input type="text" id="feedback_phone" name="feedback_phone" class="txtinput" />
						</div>
						<div class="form-group">
							<label>Location (City):</label>
							<input type="text" id="feedback_location" name="feedback_location" class="txtinput" />
						</div>
						<div class="form-group">
							<label>Message:</label>
							<textarea class="txtarea" id="feedback_comment" name="feedback_comment"></textarea>
						</div>
                        <div class="form-group">
                        	<div class="g-recaptcha" id="g-recaptcha"></div>
                            <input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">
						</div>
                        <div class="form-group">
							<input type="submit" name="feedback_submit" id="feedback_submit" value="Send" class="org-btn" />
						</div>
					</form>
					
					<div class="col-sm-12 footer_phone">
					<h3>Phone</h3>
					<div class="row">
                    <h4>United Kingdom</h4>
                    <p><a href="tel:+914412345678">+44-74529 26055</a></p>
					</div>
					
					<h3>Email</h3>
					<div class="row">
						<div class="col-sm-6">
							<h4>General inquires</h4>
							<p><a href="mailto:Info@SRAMKALAM.tv">Info@SRAMKALAM.tv</a></p>
						</div>
						<div class="col-sm-6">
							<h4>Sales inquires</h4>
							<p><a href="mailto:Sales@SRAMKALAM.tv">Sales@SRAMKALAM.tv</a></p>
						</div>
					</div>
					</div>
					</div>
				
			</div>
		</footer>
        
        <div class="modal-backdrop fade"></div>
	<div class="menu-backdrop fade"></div>
	
	<?php echo $blocks['newsadd_popup']; ?>

	<?php echo $blocks['register']; ?>
	
    <!--Mobile Change Start-->
    <div id="mobilechangeModal" class="modal modal-sm fade" tabindex="-1" role="dialog" aria-labelledby="mobilechangeModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
            	
                    <div class="modal-header">
                        <h2 class="modal-title">Mobile Number</h2>
                    </div>
                    <div class="modal-body">
                    <ul class="alert_msg alert alert_mobilechange" style="display: none;"></ul>
                    	<br>
                    
                    <div class="mobilechange_box">
                   	<?php echo form_open_multipart(frontend_url('mobilechange'),' class="form-horizontal vertical-form" id="mobilechange_form" ' );?>
                    <input type="hidden" name="country_id" value="<?php echo $relation['country_id']; ?>">
                    <div class="form-group"> 
                        <label for="inputEmail3" class="col-sm-2 col-sm-offset-2  control-label">Mobile Number<span class="required_star">*</span></label> 
                        <div class="col-sm-5">
                            <div class="input_box">
                                <input type="text" name="phone" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" value="" class="form-control number required error" aria-required="true" aria-invalid="true" >
                            </div>
                        </div> 
                    </div>
                    
                    <input type="submit" name="submit" class="btn btn-primary col-xs-2 col-sm-offset-4 " value="Submit" />
                    
					<?php
                    echo form_hidden ( 'action', 'Mobilechange' );
                    echo form_close ();
                    ?>  
                    </div>
                    
                    <div class="resendchangeotp_box" style="display:none;">
                    	<!--Mobile OTP Form-->
                        	<?php echo form_open_multipart(frontend_url('otp'),' class="form-horizontal vertical-form" id="mobileotp_form" ' );?>
                            <input type="hidden" name="active_id" value="<?php echo get_session_value('current_user_id'); ?>">
                             <div class="form-group"> 
                                <label for="inputEmail3" class="col-sm-2 col-sm-offset-1  control-label">OTP Code<span class="required_star">*</span></label> 
                                <div class="col-sm-5">
                                    <div class="input_box">
                                        <input type="text" name="otp" value="" class="form-control required error" aria-required="true" aria-invalid="true">
                                    </div>
                                </div> 
                            </div>
                            
                           
                                    <input type="submit" name="submit" class="btn btn-primary col-xs-2 col-sm-offset-4" value="Submit" />
                               
                            
                            <?php
                        
                        echo form_hidden ( 'action', 'Mobile' );
                        echo form_close ();
						
                        ?>
                        <!--Resend OTP Form-->
                        <?php echo form_open_multipart(frontend_url('resend'),' class="form-horizontal vertical-form" id="resendotp_form" ' );?>
                   				<input type="hidden" name="resend_id" value="<?php echo get_session_value('current_user_id'); ?>">
                            <input type="submit" name="submit" class="btn btn-danger col-xs-2" value="Resend OTP" />
                               
                        <?php
                        
                        echo form_hidden ( 'action', 'Resend' );
                        echo form_close ();
						
                        ?>
                    </div>
                    
                    </div>
                    <div class="modal-close">
                        <button type="button" class="modalClose" data-dismiss="modal" aria-label="Close">Close</button>
                    </div>
               
                
                
			</div>
		</div>
	</div>
    <!--Mobile Change End-->
    
    <!--Email Change Start-->
    <div id="emailchangeModal" class="modal modal-sm fade" tabindex="-1" role="dialog" aria-labelledby="emailchangeModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
            	
                    <div class="modal-header">
                        <h2 class="modal-title">Email Address</h2>
                    </div>
                    <div class="modal-body">
                    
                    <ul class="alert_msg alert alert_emailchange" style="display: none;"></ul>
                    <br>
                    	
                   <?php echo form_open_multipart(frontend_url('emailchange'),' class="form-horizontal vertical-form" id="emailchange_form" ' );?>
                    
                    <div class="form-group"> 
                        <label for="inputEmail3" class="col-sm-2 col-sm-offset-2  control-label">Email Address<span class="required_star">*</span></label> 
                        <div class="col-sm-5">
                            <div class="input_box">
                                <input type="email" name="email" value="" class="form-control required error" aria-required="true" aria-invalid="true">
                            </div>
                        </div> 
                    </div>
                    
                    <input type="submit" name="submit" class="btn btn-primary col-xs-2 col-sm-offset-4 " value="Submit" />
                    
					<?php
                    echo form_hidden ( 'action', 'Emailchange' );
                    echo form_close ();
                    ?>  
                    
                        
                    </div>
                    <div class="modal-close">
                        <button type="button" class="modalClose" data-dismiss="modal" aria-label="Close">Close</button>
                    </div>
               
                
                
			</div>
		</div>
	</div>
    <!--Email Change End-->
    
    
     <!--Resend Change Start-->
    <div id="resendchangeModal" class="modal modal-sm fade" tabindex="-1" role="dialog" aria-labelledby="resendchangeModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
            	
                    <div class="modal-header">
                        <h2 class="modal-title">Mobile Active</h2>
                    </div>
                    <div class="modal-body">
                    <ul class="alert_msg alert alert_mobilechange1" style="display: none;"></ul>
                    	<br>
                    
                    
                    
                    <div class="resendchangeotp_box">
                    	<!--Mobile OTP Form-->
                        	<?php echo form_open_multipart(frontend_url('otp'),' class="form-horizontal vertical-form" id="mobileotp1_form" ' );?>
                            <input type="hidden" name="active_id" value="<?php echo get_session_value('current_user_id'); ?>">
                             <div class="form-group"> 
                                <label for="inputEmail3" class="col-sm-2 col-sm-offset-1  control-label">OTP Code<span class="required_star">*</span></label> 
                                <div class="col-sm-5">
                                    <div class="input_box">
                                        <input type="text" name="otp" value="" class="form-control required error" aria-required="true" aria-invalid="true">
                                    </div>
                                </div> 
                            </div>
                            
                           
                                    <input type="submit" name="submit" class="btn btn-primary col-xs-2 col-sm-offset-4" value="Submit" />
                               
                            
                            <?php
                        
                        echo form_hidden ( 'action', 'Mobile' );
                        echo form_close ();
						
                        ?>
                        <!--Resend OTP Form-->
                        <?php echo form_open_multipart(frontend_url('resend'),' class="form-horizontal vertical-form" id="resendotp1_form" ' );?>
                   				<input type="hidden" name="resend_id" value="<?php echo get_session_value('current_user_id'); ?>">
                            <input type="submit" name="submit" class="btn btn-danger col-xs-2" value="Resend OTP" />
                               
                        <?php
                        
                        echo form_hidden ( 'action', 'Resend' );
                        echo form_close ();
						
                        ?>
                    </div>
                    
                    </div>
                    <div class="modal-close">
                        <button type="button" class="modalClose" data-dismiss="modal" aria-label="Close">Close</button>
                    </div>
               
                
                
			</div>
		</div>
	</div>
    <!--Resend Change End-->
    
   
    
	<!--chat module-start-->
	<?php 
	$session_enabled=($this->session->userdata('chat_session')!=''?'block':'none');
	$chat_history=get_chat_conversation(); 
	$chat_convers_count=count($chat_history);
	$visible=($chat_convers_count==0?'block':'none');
	?>
   <div class="chat-cover" style='display:<?php echo $session_enabled; ?>'>
   		<div class="top-bar">
		Leave us a message
		<span>X</span>
   		</div>
	<form name='new_chat' id='chat_form' autocomplete='off'>
	
		<div class="initial-note"  style='display:<?php echo $visible; ?>'>
				You can send your queries by entering name,email and message. Our representative will response you.
			</div>
   		<div class="chat-histroy <?php echo ($chat_convers_count==0?'':'open-chat-history') ?>">
		<?php if($chat_convers_count>0){
		foreach($chat_history as $data_conv){
		 $class_name=($data_conv["sent_by"]=='0'?'user-message':'admin-message');
		 echo '<p class="'.$class_name.'">'.htmlentities($data_conv["message"]).'<span>'.date("M h:m:a",strtotime($data_conv['time'])).'</span></p>';
		}
		} ?>
			<!-- chat histrory-->
			
   		</div> 
   		<div class='input'>
<input type='text' style='display:<?php echo $visible; ?>'  class='input-element' name='c_name' id='c_name' placeholder='Your Name*' value='<?php echo $chat_history[0]['username']; ?>'/>
   		</div>
   		   		<div class='input'>
<input type='text'  style='display:<?php echo $visible; ?>'  class='input-element' placeholder='Your Email*'  name='c_email' id='c_email' value='<?php echo $chat_history[0]['email']; ?>'/>
   		</div>
   		<div class='input'>
			<input placeholder='Enter Your Message..*' class='input-element textarea'  name='c_message' id='c_message' value=''/>
			<button class='org-btn chat-btn-submit' type='submit'>Send</button> 
			</div>
	 
	</form>
   </div>
   	<!--chat module-end-->
   