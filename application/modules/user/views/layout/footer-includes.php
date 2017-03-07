<!-- Javascript Libs -->

<script type="text/javascript" src="<?php echo load_lib() ?>bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo load_lib() ?>theme/js/Chart.min.js"></script>
<script type="text/javascript" src="<?php echo load_lib() ?>theme/js/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="<?php echo load_lib() ?>theme/js/jquery.matchHeight-min.js"></script>
<script type="text/javascript" src="<?php echo load_lib() ?>theme/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo load_lib() ?>theme/js/tag-it.js"></script>


<?php /* ?>
  <script type="text/javascript" src="<?php echo load_lib()?>theme/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="<?php echo load_lib()?>theme/js/dataTables.bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo load_lib()?>theme/js/index.js"></script>
  <?php */ ?>
<script type="text/javascript" src="<?php echo load_lib() ?>theme/js/select2.full.min.js"></script>
<script type="text/javascript" src="<?php echo load_lib() ?>theme/js/ace/ace.js"></script>
<script type="text/javascript" src="<?php echo load_lib() ?>theme/js/ace/mode-html.js"></script>
<script type="text/javascript" src="<?php echo load_lib() ?>theme/js/ace/theme-github.js"></script>

<!-- Javascript -->
<!-- <script type="text/javascript" src="<?php echo load_lib() ?>bootstrap/js/moment-with-locales.js"></script>
            <script type="text/javascript" src="<?php echo load_lib() ?>bootstrap/js/bootstrap-datetimepicker.min.js"></script>-->
<script type="text/javascript" src="<?php echo admin_skin() ?>js/pagination.js"></script>
<script type="text/javascript" src="<?php echo load_lib() ?>theme/js/custom_js.js"></script>
<script type="text/javascript" src="<?php echo load_lib() ?>jquery/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo skin_url() ?>js/login.js"></script>
<!-- BX Slider  -->
<script type="text/javascript" src="<?php echo skin_url() ?>js/jquery.bxslider.js"></script>	    
<!-- JW Player  -->
<script type='text/javascript' src='https://d2r1qawkxlrd65.cloudfront.net/jwplayer/jwplayer.js'></script>
<script type="text/javascript" src="https://d2r1qawkxlrd65.cloudfront.net/jwplayer/jwplayer.flash.swf"></script>
<script>jwplayer.key = "id/e6MPBdKcIIzMvupiJcAuD6heiP5KG4WmGaQ==";</script>
<script type="text/javascript" src="<?php echo skin_url(); ?>js/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo load_lib() ?>theme/js/site_app.js"></script>	
<script type="text/javascript">
    $("#feedback_form").validate({
        ignore: ".ignore",
        rules: {
            feedback_name: {required: true},
            feedback_company: {required: true},
            feedback_email: {required: true, email: true},
            feedback_phone: {required: true, number: true},
            feedback_location: {required: true},
            feedback_comment: {required: true},
            "hiddenRecaptcha": {
                required: function () {
                    if (grecaptcha.getResponse() == '') {
                        return true;
                    } else {
                        return false;
                    }
                }
            }
        },
        messages: {
            feedback_name: {required: "Enter your name"},
            feedback_company: {required: "Enter your company name"},
            feedback_email: {required: "Enter your email id", email: "Invaild email id"},
            feedback_phone: {required: "Enter your phone number", number: "Invaild phone number"},
            feedback_location: {required: "Enter your location"},
            feedback_comment: {required: "Enter your message"},
            "hiddenRecaptcha": {required: "Please click on the reCAPTCHA box", }
        },
        submitHandler: function () {

            $.ajax({
                url: BASE_URL + 'feedback',
                data: $('#feedback_form').serialize(),
                type: 'POST',
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        $('.feedback_status').addClass('alert-success');
                        $('.feedback_status').html('Your message has been sent!').slideDown();
                        setInterval(function () {
                            $('.feedback_status').hide();
                        }, 5000);
                        $("#feedback_name").val('');
                        $("#feedback_company").val('');
                        $("#feedback_email").val('');
                        $("#feedback_phone").val('');
                        $("#feedback_location").val('');
                        $("#feedback_comment").val('');
                    } else {
                        $('.feedback_status').addClass('alert-danger');
                        $('.feedback_status').html('Mail not sent, try again!').slideDown();
                        $("#feedback_name").val('');
                        $("#feedback_company").val('');
                        $("#feedback_email").val('');
                        $("#feedback_phone").val('');
                        $("#feedback_location").val('');
                        $("#feedback_comment").val('');
                        $('#feedback_submit').attr("disabled", false);
                    }

                }
            });

        }

    });


</script>
<script src="https://www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit&hl=en"></script>
<script type="text/javascript">
    var CaptchaCallback = function () {
        $('.g-recaptcha').each(function () {
            grecaptcha.render(this, {'sitekey': '6LeOexYUAAAAAIHWqaGS-XT0a_7mNIUws2133Jrr'});
        })
    };
</script>


