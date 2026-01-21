<?php

session_start();
require "connection.php";

$recever_email = $_SESSION["u"]["email"];
$sender_email = $_GET["e"];

$msg_rs = Database::search("SELECT * FROM `chat` WHERE `from`='" . $sender_email . "' OR `to`='" . $sender_email . "'");
$msg_num = $msg_rs->num_rows;

for ($x = 0; $x < $msg_num; $x++) {
    $msg_data = $msg_rs->fetch_assoc();

    if ($msg_data["from"] == $sender_email && $msg_data["to"] == $recever_email) {

        $user_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $msg_data["from"] . "'");
        $user_data = $user_rs->fetch_assoc();

        $img_rs = Database::search("SELECT * FROM `profile_img` WHERE `users_email`='" . $msg_data["from"] . "'");
        $img_data = $img_rs->fetch_assoc();


?>
        <!-- sender -->
        <div class="media w-75">
            <?php
            if (isset($img_data["path"])) {
            ?>
                <img src="<?php echo $img_data["path"]; ?>" width="50px" class="rounded-circle">
            <?php
            } else {
            ?>
                <img src="resource//new_user.svg" width="50px" class="rounded-circle">
            <?php
            }

            ?>
            <div class="media-body me-4">
                <div class="bg-light border-5 rounded-5 border-danger rounded py-2 px-3 mb-2">
                    <p class="mb-0 fw-bold text-black"><?php echo $msg_data["content"]; ?></p>
                </div>
                <p class="small fw-bold text-black text-end"><?php echo $msg_data["date_time"]; ?></p>
                <p class="invisible" id="rmail"><?php echo $msg_data["from"]; ?></p>
            </div>
        </div>
        <!-- sender -->
        <!--sender2-->
        <!-- <div class="message-chat media ">
            <div class="chat-body">

                <div class="message my-message">
                    <?php
                    if (isset($img_data["path"])) {
                    ?>
                        <img src="<?php echo $img_data["path"]; ?>" width="50px" class="img-circle medium-image">
                    <?php
                    } else {
                    ?>
                        <img alt="" class="img-circle medium-image" src="https://bootdey.com/img/Content/avatar/avatar1.png">
                    <?php
                    }

                    ?>



                    <div class="message-body media-body">
                        <div class="message-body-inner">
                            <div class="message-info">
                                <h4 id="rmail"><?php echo $msg_data["from"]; ?></h4>
                                <h5> <i class="fa fa-clock-o"></i> <?php echo $msg_data["date_time"]; ?></h5>
                            </div>
                            <hr>
                            <div class="message-text">
                                <?php echo $msg_data["content"]; ?>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>

            </div> -->
            <!--sender2-->
        <?php

    } else if ($msg_data["to"] == $sender_email && $msg_data["from"] == $recever_email) {

        $user_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $msg_data["from"] . "'");
        $user_data = $user_rs->fetch_assoc();

        ?>
            <!-- receiver -->
            <div class="offset-3 col-9 media w-75 text-end justify-content-end align-items-end">
                <div class="media-body">
                    <div class="bg-danger border-5 rounded-5 border-white rounded py-2 px-3 mb-2">
                        <p class="mb-0 text-white"><?php echo $msg_data["content"]; ?></p>
                    </div>
                    <p class="small fw-bold text-danger text-end"><?php echo $msg_data["date_time"]; ?></p>
                </div>
            </div>
            <!-- receiver -->
            <!-- receiver2 -->
            <!-- <div class="message info">
                            

                            <div class="message-body">
                                <div class="message-info">
                                    <h4> </h4>
                                    <h5> <i class="fa fa-clock-o"></i> <?php echo $msg_data["date_time"]; ?></h5>
                                </div>
                                <hr>
                                <div class="message-text">
                                <?php echo $msg_data["content"]; ?>
                                </div>
                            </div>
                            <br>
                        </div> -->
            <!-- receiver2 -->
    <?php
    }
    if ($msg_data["status"] == 0) {
        Database::iud("UPDATE `chat` SET `status`='1' WHERE `from`='" . $sender_email . "' 
        AND `to`='" . $recever_email . "'");
    }
}

    ?>