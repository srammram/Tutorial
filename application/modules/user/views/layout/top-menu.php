<div class="col-xs-12">
    <div class="row">
        <div class="top-head">
            <div class="logo">
                <a href="#" style="color: white;font-size:20px;font-weight: bold">PMS</a>
            </div>
            <div class="btn btn-warning pull-right" data-toggle="modal" data-target="#myNote">
                Note 
            </div>
            <?php
//            $note_list = note_list();
            ?>

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
                    <a href="javascript:void(0);" class="notificationicon <?php
                    if (!empty($notification)) {
                        echo 'noteicon';
                    }
                    ?>  on"><i class="fa fa-bell fa-2x" aria-hidden="true"></i><span>
                       <?php echo count($notification); ?>
                        </span></a>
                    <?php
                    if (!empty($notification)) {
                        ?>
                        <div class="notificationfixed" style=" width: 100%; height: 100%; position: fixed; top: 0px; left: 0px; cursor: pointer; z-index:99999999999999; display:none; "></div>
                        <ul id="notificationMenu" class="notification">

                            <div class="notifbox" id="myList">
                                <?php
                                foreach ($notification as $noty) {
                                    ?>
                                    <li class="notif">
                                        <a href="javascript:void(0);" class="update_notification" id="<?php echo $noty['id']; ?>" data-title="<?php echo $noty['notification_type']; ?>">
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
                                                    echo humanTiming($time) . ' ago';
                                                    ?>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>

                                <div class="col-xs-12 text-center">
                                    <div id="loadMore" class="btn btn-primary" style="font-size: 12px; padding: 4px 8px; margin:10px 0px;  border-radius: 0px;">Load More</div>
                                    <div id="showLess" class="btn btn-warning" style="font-size: 12px; padding: 4px 8px; margin:10px 0px;  border-radius: 0px;">Load less</div>
                                </div>
                            </div>

                        </ul>
                        <?php
                    }
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>


<?php
if (!empty($note_list)) {
    $i = 1;
    foreach ($note_list as $note_value) {
        ?>
        <div class="draggable " onchange="javascript:position(this)" style="position:absolute; left: 1100px; top: 65px; z-index:99;  cursor: move;">
            <img class="pin" src="<?php echo media_url() . 'pin.png'; ?>" alt="pin" />
            <blockquote class="quote-box" style="background-color:<?php echo $note_value['color']; ?>">
                <p class="quote-text" id="content-1">
                    <?php echo $note_value['message']; ?>
                </p>
                <hr>
                <center>
                    <a class="btn btn-success" href="#Editnote" data-toggle="modal" onclick="editnote(<?php echo $note_value['id']; ?>)"><i class="fa fa-edit"></i></a>
                    <div class="btn btn-danger" onClick="note_detele(<?php echo $note_value['id']; ?>)"><i class="fa fa-trash-o"></i></div>
                </center>
            </blockquote>
        </div>
        <?php
        $i++;
    }
}
?>

<script>
    $(document).ready(function () {
        $('#showLess').hide();
        size_li = $("#myList li").size();
        if (size_li <= 4) {
            $('#loadMore').hide();
        }
        x = 4;
        $('#myList li:lt(' + x + ')').show();
        $('#loadMore').click(function () {
            x = (x + 4 <= size_li) ? x + 4 : size_li;
            $('#myList li:lt(' + x + ')').show();
            $('#showLess').show();
            if (x == size_li) {
                $('#loadMore').hide();
            }
        });
        $('#showLess').click(function () {
            x = (x - 4 < 0) ? 4 : x - 4;
            $('#myList li').not(':lt(' + x + ')').hide();
            $('#loadMore').show();
            $('#showLess').show();
            if (x == 4) {
                $('#showLess').hide();
            }
        });
    });
</script>
