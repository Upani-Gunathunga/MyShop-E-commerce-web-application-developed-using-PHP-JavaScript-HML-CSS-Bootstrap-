<?php

session_start();
require "connection.php";

$email = $_SESSION["u"]["email"];

$category = $_POST["ca"];
$brand = $_POST["b"];
$model = $_POST["m"];
$title = $_POST["t"];
$condition = $_POST["con"];
$clr = $_POST["col"];
$qty = $_POST["qty"];
$cost = $_POST["cost"];
$dwc = $_POST["dwc"];
$doc = $_POST["doc"];
$desc = $_POST["desc"];

if (empty($category)) {
    echo ("Please Select a product category.");
}else if(empty($brand)){
    echo ("Please Select a product brand.");
}else if(empty($model)){
    echo ("Please Select a product model.");
} else if (empty($title)) {
    echo ("Please enter the product title and product condition.");
} else if (empty($desc)) {
    echo ("Please add a product description.");
} else if (empty($clr)) {
    echo ("Please add or select the product color.");
} else if (empty($qty)) {
    echo ("Please enter product quantity in stock.");
} else if (empty($cost)) {
    echo ("Please enter cost per product item.");
} else if (empty($dwc)) {
    echo ("Please enter delivery fee within colombo.");
} else if (empty($doc)) {
    echo ("Please enter delivery fee out of colombo.");


} else {
    $mhb_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `model_model_id`='" . $model . "'
AND `brand_brand_id`='" . $brand . "' ");

    $mhb_id;
    if ($mhb_rs->num_rows > 0) {
        $mhb_data = $mhb_rs->fetch_assoc();
        $mhb_id = $mhb_data["id"];
    } else {
        Database::search("INSERT INTO `model_has_brand`(`model_model_id`,`brand_brand_id`) VALUES(" . $model . "','" . $brand . "')");

        $mhb_id = Database::$connection->insert_id;
    }

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");
    $status = 1;

    Database::iud("INSERT INTO `product`(`price`,`qty`,`description`,`title`,`datetime_added`,`delivery_fee_colombo`,
`delivery_fee_other`,`category_cat_id`,`model_has_brand_id`,`color_clr_id`,`status_status_id`,`condition_condition_id`,`users_email`) 
VALUES('" . $cost . "','" . $qty . "','" . $desc . "','" . $title . "','" . $date . "'
,'" . $dwc . "','" . $doc . "','" . $category . "','" . $mhb_id . "','" . $clr . "','" . $status . "','" . $condition . "','" . $email . "')");

    $product_id = Database::$connection->insert_id;

    $length = sizeof($_FILES);
    if ($length <= 3 && $length > 0) {

        $allowed_img_extensions = array("image/jpg", "image/jpeg", "image/png", "image/svg+xml");

        for ($x = 0; $x < $length; $x++) {
            if (isset($_FILES["img" . $x])) {

                $img_file = $_FILES["img" . $x];
                $file_extension = $img_file["type"];

                if (in_array($file_extension, $allowed_img_extensions)) {
                    $new_img_extension;

                    if ($file_extension == "image/jpg") {
                        $new_img_extension = ".jpg";
                    } else if ($file_extension == "image/jpeg") {
                        $new_img_extension = ".jpeg";
                    } else if ($file_extension == "image/png") {
                        $new_img_extension = ".png";
                    } else if ($file_extension == "image/svg+xml") {
                        $new_img_extension = ".svg";
                    }

                    $file_name = "resources//mobile_images//" . $title . "_" . $x . "_" . uniqid() . $new_img_extension;
                    move_uploaded_file($img_file["tmp_name"], $file_name);

                    Database::iud("INSERT INTO `product_img`(`img_path`,`product_id`) VALUES
            ('" . $file_name . "','" . $product_id . "')");

                    echo ("success");
                } else {
                    echo ("Not an allowed image type");
                }
            }
        }
    } else {
        echo ("Invalid image count.");
    }
}
