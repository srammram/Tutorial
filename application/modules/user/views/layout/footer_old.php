
<footer>
    <div class="row">
        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 footer_section1">
            <?php echo $blocks['site_footer']; ?>
        </div>

        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 footer_section2">
            <nav class="footer-menu">
                <ul>
                    <?php echo strip_tags($blocks['cms_menu'], '<li><a><ul>'); ?>
                </ul>
            </nav>
			
           
            <a href="#myModal" role="button" class="btn btn-primary btn-lg" data-toggle="modal">Send Feedback</a>

            <div id="myModal" class="modal modal-sm fade" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h2 class="modal-title">Send Feedback</h2>
                        </div>
                        <div class="modal-body">
                            <ul class=" alert_msg  alert container_alert" style="display: none;"></ul>	
                            <br>
                            <div class="box1">
                                <form action="<?php echo frontend_url() . 'feedback'; ?>" id="feedback_form" name="feedback_form" method="post" class="contact-form form-horizontal vertical-form" >
                                    <div class="form-group"> 
                                        <label for="inputEmail3" class="col-sm-2 col-sm-offset-1  control-label">Your Name<span class="required_star">*</span></label> 
                                        <div class="col-sm-6">
                                            <div class="input_box">
                                                <input type="text" onkeypress="return alpha(event)" id="feedback_name" name="feedback_name" value="" class="form-control required error" aria-required="true" aria-invalid="true">
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="form-group"> 
                                        <label for="inputEmail3" class="col-sm-2 col-sm-offset-1  control-label">Company<span class="required_star">*</span></label> 
                                        <div class="col-sm-6">
                                            <div class="input_box">
                                                <input type="text" onkeypress="return alpha(event)" id="feedback_company" name="feedback_company" value="" class="form-control required error" aria-required="true" aria-invalid="true">
                                            </div>
                                        </div> 
                                    </div>

                                    <div class="form-group"> 
                                        <label for="inputEmail3" class="col-sm-2 col-sm-offset-1  control-label">Email Address<span class="required_star">*</span></label> 
                                        <div class="col-sm-6">
                                            <div class="input_box">
                                                <input type="email" id="feedback_email" name="feedback_email" value="" class="form-control required error" aria-required="true" aria-invalid="true">
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="form-group"> 
                                        <label for="inputEmail3" class="col-sm-2 col-sm-offset-1  control-label">Mobile Number<span class="required_star">*</span></label> 
                                        <div class="col-sm-6">
                                            <input type="text" id="feedback_phone" name="feedback_phone" value="" class="form-control number">
                                        </div>

                                    </div>

                                    <div class="form-group city_name"> 
                                        <label for="inputEmail3" class="col-sm-2 col-sm-offset-1  control-label">Location (City)<span class="required_star">*</span></label> 
                                        <div class="col-sm-6">
                                            <div class="input_box">
                                                <input type="text" id="feedback_location" name="feedback_location" class="form-control required error" aria-required="true" aria-invalid="true">
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="form-group"> 
                                        <label for="inputEmail3" class="col-sm-2 col-sm-offset-1  control-label">Message<span class="required_star">*</span></label> 
                                        <div class="col-sm-6">
                                            <textarea class="txtarea" onkeypress="return alpha(event)" id="feedback_comment" name="feedback_comment" class="form-control required error" aria-required="true" aria-invalid="true"></textarea>
                                        </div> 
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-6">
                                            <div class="g-recaptcha" id="g-recaptcha"></div>
                                            <input type="hidden" class="hiddenRecaptcha required" name="hiddenRecaptcha" id="hiddenRecaptcha">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-4"></div>
                                        <div class="col-sm-6">
                                            <input type="submit" name="feedback_submit" id="feedback_submit" value="Send" class="org-btn" />
                                        </div>
                                    </div>
                                    <div class="alert alert-success feedback_status text-center" style="display:none">

                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="modal-close">
                            <button type="button" class="modalClose" data-dismiss="modal" aria-label="Close">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="footer_social">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 social-media">
                <a href="" class="f-facebook"></a>
                <a href="" class="f-twitter"></a>
                <a href="" class="f-googleplus"></a>
                <a href="" class="f-linkedin"></a>
                <a href="" class="f-rss"></a>
                <a href="" class="f-youtube"></a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 footer_phone">
                <h3>Phone <i>{</i></h3>

                <span><h4>United Kingdom</h4>
                    <p>+44-74529 26055</p></span>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 footer_phone1">
                <h3>Email<i>{</i></h3>
                <div class="col-xs-6">
                    <span><h4>General inquires</h4>
                        <p>Info@SRAMKALAM.tv</p></span>
                </div>
                <div class="col-xs-6 footer_mailkalam">
                    <span><h4>Sales inquires</h4>
                        <p>Sales@SRAMKALAM.tv</p></span>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="mobile_footer">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 mobile_mailid">
                <p><i class="fa fa-phone" aria-hidden="true"></i> <a href="tel:+914412345678">+44-74529 26055</a></p>
                <p><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:Info@SRAMKALAM.tv">Info@SRAMKALAM.tv</a></p>
                <p><i class="fa fa-envelope" aria-hidden="true"></i> <a href="mailto:Sales@SRAMKALAM.tv">Sales@SRAMKALAM.tv</a></p></span>
            </div>
            <div class="col-xs-12 mobile_social social-media">
                <a href="https://www.facebook.com/Electtv-381900905527390/" class="f-facebook" target="_blank"></a>
                <a href="https://twitter.com/ElecttvNews" class="f-twitter" target="_blank"></a>
                <a href="https://plus.google.com/u/0/104337806157636605910" class="f-googleplus" target="_blank"></a>
                <a href="www.linkedin.com/in/elect-tv" class="f-linkedin"target="_blank"></a>
                <a href="" class="f-rss" target="_blank"></a>
                <a href="https://www.youtube.com/channel/UCFSWERiJfZQWOXCi9bx3GLg" class="f-youtube" target="_blank"></a>
            </div>
        </div>
    </div>
</div>
<div class="footer_rights">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <p class="copy">&copy; 2017 <a href="<?php echo base_url(); ?>" title="Elect Tv">Elect Tv.</a> All rights reserved.</p>
            </div>
        </div>
    </div>
</div>

<div class="modal-backdrop fade"></div>
<div class="menu-backdrop fade"></div>

<?php echo $blocks['newsadd_popup']; ?>

<?php echo $blocks['register']; ?>

<!--Login Forms Start-->
<div id="loginformsmodel" class="modal modal-sm fade" tabindex="-1" role="dialog" aria-labelledby="loginformsmodel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h2 class="modal-title">Login Forms</h2>
            </div>
            <div class="modal-body">
                <ul class="alert_msg alert alert_mobilechange" style="display: none;"></ul>
                <br>

                <div class="loginforms_box">
                    <?php echo form_open_multipart(frontend_url('register'), ' class="form-horizontal vertical-form" id="register_form" '); ?>
                    <div class="form-group col-sm-6 col-sm-offset-3"> 

                        <div class="col-sm-12">
                            <div class="input_box">
                                <input type="text" name="last_name" class="form-control" placeholder="Email Or Mobile">
                            </div>
                        </div> 
                    </div>
                    <div class="form-group col-sm-6 col-sm-offset-3"> 
                        <div class="col-sm-12">
                            <div class="input_box">
                                <input type="text" name="last_name" class="form-control" placeholder="Password">
                            </div>
                        </div> 
                    </div>
                    <?php echo form_submit('submit', 'Submit', ' id="register_submit" class="btn btn-primary col-xs-2 col-sm-offset-5" ') ?>
                    <?php
                    echo form_hidden('action', 'Login');
                    echo form_close();
                    ?>
                    <br>
                    <br>
                    <p class="col-xs-12 text-center">Or Login With</p>
                    <br>
                    <div class="modal-social-icons col-sm-6 col-sm-offset-3">
                        <div class="col-sm-6"><a href='https://www.facebook.com/dialog/oauth?client_id=254499755009557&redirect_uri=http%3A%2F%2Fstaging.sramkalam.tv%2Fuser%2Floginforms%2Ffacebooklogin&state=2e652ff7136cbaf938f751972947a8d0&scope=elect.test%40yandex.com' class="facebook"> <i class="fa fa-facebook modal-icons"></i> Sign In with Facebook </a></div>
                        <div class="col-sm-6">



                            <a href='https://accounts.google.com/o/oauth2/auth?response_type=code&redirect_uri=http%3A%2F%2Fstaging.sramkalam.tv%2Fuser%2Floginforms%2Fgooglelogin%2F&client_id=221900517819-4slu7c6d0ma75g53rkasoneu30dmp5su.apps.googleusercontent.com&scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email&access_type=offline&approval_prompt=force' class="google"> <i class="fa fa-google-plus modal-icons"></i> Sign In with Google </a></div>
                    </div>
                    <br>
                    <br>
                </div>

                <div class="forgotforms_box" style="display:none;">

                </div>

            </div>
            <div class="modal-close">
                <button type="button" class="modalClose" data-dismiss="modal" aria-label="Close">Close</button>
            </div>



        </div>
    </div>
</div>
<!--Login Forms End-->

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
                    <?php echo form_open_multipart(frontend_url('mobilechange'), ' class="form-horizontal vertical-form" id="mobilechange_form" '); ?>
                    <input type="hidden" name="country_id" value="<?php echo $relation['country_id']; ?>">
                    <div class="form-group"> 
                        <label for="inputEmail3" class="col-sm-2 col-sm-offset-2  control-label">Mobile Number<span class="required_star">*</span></label> 
                        <div class="col-sm-5">
                            <div class="input_box">
                                <input type="text" name="phone" onkeyup="if (/\D/g.test(this.value))
                                            this.value = this.value.replace(/\D/g, '')"  class="form-control number required error" aria-required="true" aria-invalid="true" value="<?php echo get_session_value('user_mobile'); ?>">
                            </div>
                        </div> 
                    </div>

                    <input type="submit" name="submit" class="btn btn-primary col-xs-2 col-sm-offset-4 " value="Submit" />

                    <?php
                    echo form_hidden('action', 'Mobilechange');
                    echo form_close();
                    ?>  
                </div>

                <div class="resendchangeotp_box" style="display:none;">
                    <!--Mobile OTP Form-->
                    <?php echo form_open_multipart(frontend_url('otp'), ' class="form-horizontal vertical-form" id="mobileotp_form" '); ?>
                    <input type="hidden" name="active_id" value="<?php echo get_session_value('current_user_id'); ?>">
                    <div class="form-group"> 
                        <label for="inputEmail3" class="col-sm-2 col-sm-offset-1  control-label">OTP Code<span class="required_star">*</span></label> 
                        <div class="col-sm-5">
                            <div class="input_box">
                                <input type="text" name="otp" value="" class="form-control required error" aria-required="true" aria-invalid="true" onkeyup="if (/\D/g.test(this.value))
                                            this.value = this.value.replace(/\D/g, '')">
                            </div>
                        </div> 
                    </div>


                    <input type="submit" name="submit" class="btn btn-primary col-xs-2 col-sm-offset-4" value="Submit" />


                    <?php
                    echo form_hidden('action', 'Mobile');
                    echo form_close();
                    ?>
                    <!--Resend OTP Form-->
                    <?php echo form_open_multipart(frontend_url('resend'), ' class="form-horizontal vertical-form" id="resendotp_form" '); ?>
                    <input type="hidden" name="resend_id" value="<?php echo get_session_value('current_user_id'); ?>">
                    <input type="submit" name="submit" class="btn btn-danger col-xs-2" value="Resend OTP" />

                    <?php
                    echo form_hidden('action', 'Resend');
                    echo form_close();
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

                <?php echo form_open_multipart(frontend_url('emailchange'), ' class="form-horizontal vertical-form" id="emailchange_form" '); ?>

                <div class="form-group"> 
                    <label for="inputEmail3" class="col-sm-2 col-sm-offset-2  control-label">Email Address<span class="required_star">*</span></label> 
                    <div class="col-sm-5">
                        <div class="input_box">
                            <input type="email" name="email" value="<?php echo get_session_value('user_email'); ?>" class="form-control required error" aria-required="true" aria-invalid="true">
                        </div>
                    </div> 
                </div>

                <input type="submit" name="submit" class="btn btn-primary col-xs-2 col-sm-offset-4 " value="Submit" />

                <?php
                echo form_hidden('action', 'Emailchange');
                echo form_close();
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
                <h2 class="modal-title">Activate Your Mobile Number</h2>
            </div>
            <div class="modal-body">
                <ul class="alert_msg alert alert_mobilechange1" style="display: none;"></ul>
                <br>
                <div class="resendchangeotp_box">
                    <!--Mobile OTP Form-->
                    <?php echo form_open_multipart(frontend_url('otp'), ' class="form-horizontal vertical-form" id="mobileotp1_form" '); ?>
                    <input type="hidden" name="active_id" value="<?php echo get_session_value('current_user_id'); ?>">
                    <div class="form-group"> 
                        <label for="inputEmail3" class="col-sm-2 col-sm-offset-1  control-label">OTP Code<span class="required_star">*</span></label> 
                        <div class="col-sm-5">
                            <div class="input_box">
                                <input onkeyup="if (/\D/g.test(this.value))
                                            this.value = this.value.replace(/\D/g, '')" type="text" name="otp" value="" class="form-control required error" aria-required="true" aria-invalid="true">
                            </div>
                        </div> 
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary col-xs-2 col-sm-offset-4" value="Submit" />
                    <?php
                    echo form_hidden('action', 'Mobile');
                    echo form_close();
                    ?>
                    <!--Resend OTP Form-->
                    <?php echo form_open_multipart(frontend_url('resend'), ' class="form-horizontal vertical-form" id="resendotp1_form" '); ?>
                    <input type="hidden" name="resend_id" value="<?php echo get_session_value('current_user_id'); ?>">
                    <input type="submit" name="submit" class="btn btn-danger col-xs-2" value="Resend OTP" />
                    <?php
                    echo form_hidden('action', 'Resend');
                    echo form_close();
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
$session_enabled = ($this->session->userdata('chat_session') != '' ? 'block' : 'none');
$chat_history = get_chat_conversation();
$chat_convers_count = count($chat_history);
$visible = ($chat_convers_count == 0 ? 'block' : 'none');
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
        <div class="chat-histroy <?php echo ($chat_convers_count == 0 ? '' : 'open-chat-history') ?>">
            <?php
            if ($chat_convers_count > 0) {
                foreach ($chat_history as $data_conv) {
                    $class_name = ($data_conv["sent_by"] == '0' ? 'user-message' : 'admin-message');
                    echo '<p class="' . $class_name . '">' . htmlentities($data_conv["message"]) . '<span>' . date("M h:m:a", strtotime($data_conv['time'])) . '</span></p>';
                }
            }
            ?>
            <!-- chat histrory-->
        </div> 
        <div class='input'>
            <input type='text' style='display:<?php echo $visible; ?>'  class='input-element' name='c_name' id='c_name' placeholder='Your Name*' value='<?php echo get_session_value('user_name'); ?>'/>
        </div>
        <div class='input'>
            <input type='text'  style='display:<?php echo $visible; ?>'  class='input-element' placeholder='Your Email*'  name='c_email' id='c_email' value='<?php echo get_session_value('user_email'); ?>'/>
        </div>
        <div class='input'>
            <input placeholder='Enter Your Message..*' class='input-element textarea'  name='c_message' id='c_message' value=''/>
            <button class='org-btn chat-btn-submit' type='submit'>Send</button> 
        </div>
    </form>
</div>
<!--chat module-end-->
<script type="text/javascript">
    function alpha(e) {
        var k;
        document.all ? k = e.keyCode : k = e.which;
        return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8 || k == 32 || k == 13 || (k > 47 && k < 58) || k == 45 || k == 95 || k == 46 || k == 47 || k == 44);
    }
</script>