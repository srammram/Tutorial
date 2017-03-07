<div class="clear" style="clear: both;height:10em"></div>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-12">
                            <a href="#" class="active" id="login-form-link">Login</a>
                        </div>
                        <!--                    <div class="col-xs-6">
                                                <a href="#" id="register-form-link">Register</a>
                                            </div>-->
                    </div>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="login-form" action="<?php echo frontend_url() . 'login'; ?>" method="post" role="form" style="display: block;" data-parsley-validate="">
                                <div class="form-group">
                                    <input type="email" name="emailaddress" id="emailaddress" tabindex="1" class="form-control" placeholder="Email Address" value="" required="" data-parsley-type="email">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" required="" data-parsley-minlength="6">
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="text-center">
                                                <a href="" tabindex="5" class="forgot-password" id="forgot-form-link">Forgot Password?</a>
                                                <a href="" tabindex="5" class="forgot-password" id="hide-login-link" style="display:none">Login</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                            <form id="forgot-form" action="" method="post" role="form" style="display: none;">

                                <div class="form-group">
                                    <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="text-center">

                                                <a href="" tabindex="5" class="forgot-password" >Login</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="forgot-submit" id="forgot-submit" tabindex="4" class="form-control btn btn-register" value="Send">
                                        </div>
                                    </div>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clear" style="clear: both;height:10em"></div>
