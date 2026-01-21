<?php
session_start();
require "connection.php";

?>


<!DOCTYPE html>
<html>

<head>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="bootstrap.css" />

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="icon" href="resources/newtech logo.png" />
    <title>New Tech</title>
</head>

<body class="main-body">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-12   mb-2">
                <div class="col-12" style="height: 200px;">

                </div>
                <?php include "header.php";

                if (isset($_SESSION["u"])) {
                    $mail = $_SESSION["u"]["email"];

                    $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `user_mail`='" . $mail . "'");
                    $invoice_num = $invoice_rs->num_rows;
                ?>

                    <div class="col-12 ">
                        <P class="fs-1 text-text-danger-emphasis fw-bold mt-3 pt-2 text-lg-start text-center">Purchasing History</P>
                    </div>
                    <div class="col-12">
                        <hr class="border border-3 border-danger">
                    </div>

                    <?php

                    if ($invoice_num == 0) {
                    ?>
                        <div class="col-12 text-center bg-body" style="height: 450px;">
                            <span class="fs-1 fw-bold text-black-50 d-block" style="margin-top: 200px;">
                                You have not purchased any item yet...
                            </span>
                        </div>

                    <?php
                    } else {
                    ?>

                        <div class="table-wrap flex-wrap">
                            <table class="table table-responsive  table-borderless">
                                <thead>
                                    <th>#</th>
                                    <th>&nbsp;</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>total</th>
                                    <th>Date & Time</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                </thead>
                                <tbody>

                                    <?php

                                    for ($x = 0; $x < $invoice_num; $x++) {
                                        $invoice_data = $invoice_rs->fetch_assoc();

                                    ?>

                                        <tr class="align-middle alert border-bottom border-danger border-4 bg-dark bg-opacity-0 text-white" role="alert">
                                            <td>
                                                <span class="text-white"><?php echo $invoice_data["id"]; ?></span>
                                            </td>
                                            <td class="text-center">
                                            <?php
                                                            $pid = $invoice_data["product_id"];
                                                            $image_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $pid . "' ");
                                                            $image_data = $image_rs->fetch_assoc();
                                                            $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "' ");
                                                                $product_data = $product_rs->fetch_assoc();

                                                                $seller_rs = Database::search("SELECT * FROM `users` WHERE `email`='" . $product_data["users_email"] . "' ");
                                                                $seller_data = $seller_rs->fetch_assoc();
                                                            ?>
                                                <img class="pic" src="<?php echo $image_data["img_path"]; ?>" alt="">
                                            </td>
                                            <td>
                                                <div>
                                                    
                                                    <p class="m-0 fw-bold"><?php echo $product_data["title"]; ?></p>
                                                    <p class="m-0 text-muted">Seller: <?php echo $seller_data["fname"] . " " . $seller_data["fname"]; ?></p>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="fw-600">Rs. <?php echo $product_data["price"]; ?></div>
                                            </td>
                                            <td class="d-">
                                                <input class="input" type="text" placeholder="<?php echo $invoice_data["qty"]; ?>">
                                            </td>
                                            <td>
                                            Rs. <?php echo $invoice_data["total"]; ?>
                                            </td>
                                            <td>
                                            <?php echo $invoice_data["date"]; ?>
                                            </td>

                                            <td>
                                                <div class="btn" data-bs-dismiss="alert">
                                                    <span class="fas fa-times">Remove &nbsp;<i class="bi bi-x-circle-fill"></i></span>
                                                </div>
                                            </td>
                                            <td>
                                            <button class="btn btn-outline-info   fs-5" onclick="addFeedback(<?php echo $invoice_data['product_id']; ?>);">
                                                        <i class="bi bi-info-circle-fill"></i> Feedback
                                                    </button>
                                            </td>
                                        </tr>
                                    <?php
                                    }

                                    ?>






                                </tbody>
                            </table>
                        </div>
                <?php
                    }
                }

                ?>
            </div>
             <!-- model -->
             <div id="feedbackModal<?php echo $pid; ?>" class="modal" tabindex="-1" >
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <h5 class="modal-title fw-bold text-white">Add New Feedback</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        
                                        <div class="modal-body">
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label class="form-label fw-bold">Type</label>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="type" id="type1"/>
                                                                    <label class="form-check-label text-danger fw-bold" for="type1">
                                                                        Positive
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="type" id="type2" checked/>
                                                                    <label class="form-check-label text-warning fw-bold" for="type2">
                                                                        Neutral
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" name="type" id="type3"/>
                                                                    <label class="form-check-label text-dark fw-bold" for="type3">
                                                                        Negative
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="border-4 border-danger-subtle">
                                                    <div class="col-12">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label class="form-label fw-bold">User's Email</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <input type="text" class="form-control" id="mail" 
                                                                value="<?php echo $mail; ?>"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="border-4 border-danger-subtle">
                                                    <div class="col-12 mt-2">
                                                        <div class="row">
                                                            <div class="col-3">
                                                                <label class="form-label fw-bold">Feedback</label>
                                                            </div>
                                                            <div class="col-9">
                                                                <textarea class="form-control" cols="50" rows="8" id="feed"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="border-4 border-danger-subtle">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger col-6" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-outline-danger col-6" onclick="saveFeedback(<?php echo $pid; ?>);">Save Feedback</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- model -->







        </div>
        <div class="col-12 mx">
            <?php include "footer.php"; ?>

        </div>

    </div>



    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
    <script src="bootstrap.bundle.min.js"></script>
</body>

</html>