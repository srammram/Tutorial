<?php
$id = "";
$id = get_session_value('current_user_id');
?>
<header>
    <div class="container hidden-xs">
        <div class="logo"><a href="<?php echo BASE_URL; ?>">Elect TV</a></div>
        <div  class="head-right-section">
            <ul id="campaign_slider">
                <li><img src="<?php echo media_url() . 'campaign/electtv_banner01.jpg'; ?>" title="" /></li>
                <li><img src="<?php echo media_url() . 'campaign/electtv_banner02.jpg'; ?>" title="" /></li>
                <li><img src="<?php echo media_url() . 'campaign/electtv_banner03.jpg'; ?>" title="" /></li>
            </ul>
        </div>
        <li class="m-chat"><a  href="#loginformsmodel" data-toggle="modal">Login</a></li>
        <?php echo $blocks['winner_list']; ?>

    </div>
    <nav class="header-menu">
        <div class="container">
            <a href="" class="logo  hidden-sm hidden-md hidden-lg">Elect TV</a>
            <div class="pull-right hidden-sm hidden-md hidden-lg">
                <a href="" class="lmenu"></a>
                <a href="" class="rmenu"></a>
            </div>
            <ul class="right-menu pull-right hidden-xs">
                <li class="m-upload <?php
                if (!$id) {
                    echo 'toggle-link';
                }
                ?>"  >
                        <?php
                        if ($id) {
                            ?>
                        <a href="#uploadModal" data-toggle="modal">Upload</a>
                    <?php } else { ?>
                        <a href="#">Upload</a>
                        <?php echo $blocks['login_popup']; ?>
                    <?php } ?>
                </li>
                <li class="m-chat"><a href="javascript:chat_session()">Live Chat</a></li>

                <li class="m-weather toggle-link hidden-sm">
                    <a href="#">Weather</a>
                    <div class="submenu-container">
                        <div class="weather-container">
                            <?php
                            $q = ($this->session->userdata('weather_area') == '' ? 'lucknow' : $this->session->userdata('weather_area'));
                            $details_weather = json_decode(file_get_contents('http://api.openweathermap.org/data/2.5/weather?q=' . $q . '&APPID=' . WEATHER_API), TRUE);
                            $country_arr = get_country_short_arr($details_weather["sys"]["country"]);
                            $weather_depth = json_decode(file_get_contents('http://api.apixu.com/v1/current.json?key=' . WEATHER_API_CURRENT . "&q=" . $details_weather["name"]), TRUE);
                            $celcius = $weather_depth['current']['temp_c'];
                            ?>
                            <fieldset>
                                <div class="place country-label"><?php echo $details_weather["name"] . ',' . $country_arr[$details_weather["sys"]["country"]] ?></div>
                                <span class="settings"><a href=""></a></span>
                            </fieldset>
                            <fieldset>
                                <div class="time current-time"> <?php echo date("h:m"); ?><br /><?php echo date("A"); ?></div>
                                <div class="degree sunny pull-left temp_min">
                                    <?php echo $celcius; ?><sup>o</sup>
                                </div> 
                            </fieldset>
                            <fieldset>

                                <div class="value humidity"><em>Humidity</em><br /><?php echo $details_weather['main']['humidity']; ?>%</div>
                                <div class="value precip"><em>Precip.</em><br /><?php echo number_format($details_weather['sys']['message'], 2) . " " . strtolower($details_weather["sys"]["country"]); ?></div>
                                <div class="value winds"><em>Winds</em><br /><?php echo $details_weather['wind']['speed']; ?> mph</div>


                            </fieldset>
                        </div>
                        <div class="weather-setting">
                            <fieldset>
                                <div class="place">Settings</div>
                                <span class="settings close"><a href=""></a></span>
                            </fieldset>
                            <fieldset class="submenu-form">
                                <p>Enter City, State or Zip Code</p>
                                <label for="m-city" class="location">City, State or Zip Code</label>
                                <input type="text" id="m-city" placeholder="Enter City, State or Zip Code" class="lbox-txt" />
                            </fieldset>
                            <fieldset class="text-right">
                                <input type="button" class="lbox-btn cancel-btn" value="Cancel" />
                                <input type="button" class="lbox-btn change-weather" value="Set" />
                            </fieldset>
                        </div>
                    </div>
                </li>
                <li class="m-search toggle-link">
                    <a href="#">Search</a>
                    <div class="submenu-container">

                        <fieldset class="text-right search_fieldset"> 
                            <input autocomplete='off' type="text" id="m-srch" placeholder="Keyword to search" class="lbox-txt search-input" />
                            <input type="button" id="m-srch-btn" class="lbox-btn" value="Search" onclick='search_news()' />
                            <ul class='search-suggestion'> 
                            </ul>
                        </fieldset>

                    </div>
                </li>
                <?php
                if (!empty(get_session_value('current_user_id'))) {
                    ?>
                    <li class="m-target toggle-link">
                        <a href="#" class="target_link">Target</a>

                        <div class="submenu-container">
                            <div id="newscount">

                            </div>
                        </div>

                    </li>
                    <?php
                }
                ?>
                <li class="m-map toggle-link">
                    <a href="#">Your at here</a>
                    <div class="submenu-container">
                        <?php if (!empty(get_session_value('current_user_id'))): ?>
                            <p>Constituency name - <?php echo get_session_value('constituency_name') ?></p>

                        <?php else:
                            ?>
                            <p>Login and see your constituency name </p>

                        <?php
                        endif;
                        ?>
                    </div>
                </li>
                <li class="m-profile toggle-link">
                    <a href="#">Profile</a>
                    <div class="submenu-container">
                        <?php
                        if (empty(get_session_value('current_user_id'))) {
                            ?>
                            <div class="login_faild2">
                                <div class="alert log_alert_box" role="alert" style="display:none;"></div>   
                                <?php echo form_open(frontend_url('login'), 'class="submenu-form login_form_box"  id="login_form_box" autocomplete= "' . form_autocomplte() . '" '); ?>

                                <fieldset>
                                    <label for="m-username" class="uName">User Name</label>
                                    <input type="text" name="username" placeholder="User Name" class="lbox-txt" />
                                </fieldset>
                                <fieldset>
                                    <label for="m-password" class="pWord">Password</label>
                                    <input type="password" name="password" placeholder="Password" class="lbox-txt" />
                                </fieldset>
                                <fieldset class="text-right">
                                    <input type="reset" class="lbox-btn cancel-btn" value="Reset" />
                                    <?php echo form_submit('submit', 'Login', ' id="login_submit_box" class="lbox-btn" ') ?>
                                </fieldset>
                                <p><a href="javascript:void(0);" class="forgot2">Forgot Password?</a></p>
                                <p>Not a member? <a href="#registerModal" data-toggle="modal">Register!!!</a></p>
                                </form>
                            </div>
                            <div class="forgot_box2" style="display:none;">
                                <div class="alert forgot_msg_box2" role="alert" style="display:none;"></div>   
                                <?php echo form_open(frontend_url('forgotpassword'), 'class="submenu-form"  id="forgot_form_box2" autocomplete= "' . form_autocomplte() . '" '); ?>
                                <fieldset>
                                    <label for="m-email" class="uName">Email</label>
                                    <input type="text" name="email" placeholder="Email Address" class="lbox-txt" />
                                </fieldset>
                                <fieldset class="text-right">
                                    <input type="reset" class="lbox-btn cancel-btn" value="Reset" />
                                    <?php echo form_submit('submit', 'Forgot', ' id="forgot_submit_box" class="lbox-btn" ') ?>
                                </fieldset>
                                <p><a href="javascript:void(0);" class="login2">Login</a></p>
                                <?php echo form_close(); ?>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="login_success">
                                <p>Name : <?php echo get_session_value('first_name') . ' ' . get_session_value('last_name'); ?></p>
                                <p>Email : <?php echo get_session_value('email'); ?></p>
                                <p>Phone : <?php echo get_session_value('phone'); ?></p>
                                <p><a href="<?php
                                    if (get_session_value('is_public') == '0') {
                                        echo frontend_url('empolyee');
                                    } else {
                                        echo frontend_url('dashboard');
                                    }
                                    ?>">Profile View</a></p>
                                <p><a href="<?php echo frontend_url('logout'); ?>">Logout?</a></p>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </li>
            </ul>
            <?php echo $blocks['site_header']; ?>
            

        </div>
    </nav>



</header>

