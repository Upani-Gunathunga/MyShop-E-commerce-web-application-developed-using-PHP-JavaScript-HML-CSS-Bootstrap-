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

<body class="mt-2" style="background-color: #f7f7ff;">

    <div class="container-fluid">
        <div class="row">
            <?php
            include "header.php";

            if (isset($_SESSION["u"])) {

                $umail = $_SESSION["u"]["email"];
                $oid = $_GET["id"];
            ?>
                <div class="col-12">
                    <hr />
                </div>

                <div id="page" data-select2-id="page">
                    <div>
                        <div class="card">
                            <?php

                            $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $oid . "' ");
                            $invoice_data = $invoice_rs->fetch_assoc();

                            ?>
                            <div class="card-header bg-danger-subtle">Invoice
                                <strong><?php echo  $oid; ?></strong>
                                <a class="btn btn-sm btn-danger float-right mr-1 d-print-none" href="#" onclick="printInvoice();" data-abc="true">
                                    <i class="fa fa-print"></i> Print</a>
                                <a class="btn btn-sm btn-dark float-right mr-1 d-print-none" href="#" onclick="" data-abc="true">
                                    <i class="fa fa-save"></i> Save</a>
                            </div>
                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-sm-4">
                                        <h6 class="mb-3">From:</h6>
                                        <div>
                                            <strong>newtech.lk</strong>
                                        </div>
                                        <div>45/B, Cambrige Lane</div>
                                        <div>Colombo 10, Sri Lanka, 10394</div>
                                        <div>Email: newtechsales@gmail.com</div>
                                        <div>Phone: +94 763 456 789</div>
                                    </div>
                                    <div class="col-sm-4">


                                        <?php
                                        $address_rs = Database::search("SELECT * FROM `users_has_address` INNER JOIN `users` ON 
                                users.email = users_has_address.users_email WHERE 
                                    `users_email` = '" . $umail . "'");

                                        $address_data = $address_rs->fetch_assoc();

                                        ?>
                                        <h6 class="mb-3">To:</h6>
                                        <div>
                                            <strong><?php echo $_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]; ?></strong>
                                        </div>
                                        <div><?php echo $address_data["line1"]; ?></div>
                                        <div><?php echo  $address_data["line2"]; ?></div>
                                        <div>Postal Code: <?php echo  $address_data["postal_code"]; ?></div>
                                        <div>Email: <?php echo  $umail; ?></div>
                                        <div>Phone: <?php echo  $address_data["mobile"]; ?></div>
                                    </div>
                                    <div class="col-sm-4">
                                        <h6 class="mb-3">Details:</h6>

                                        <div>Invoice
                                            <strong><?php echo  $oid; ?></strong>
                                        </div>
                                        <div><?php echo $invoice_data["date"]; ?></div>



                                    </div>
                                </div>
                                <div class="table-responsive-sm">
                                    <table class="table table-striped-columns border-danger">
                                        <thead>
                                            <tr>
                                                <th class="center">#</th>
                                                <th>Order Id</th>
                                                <th>Product</th>
                                                <th class="center">Quantity</th>
                                                <th class="right">Unit Cost</th>
                                                <th class="right">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
                                                $product_rs = Database::search("SELECT * FROM `product` WHERE 
                                                 `id`='" . $invoice_data["product_id"] . "' ");
                                                $product_data = $product_rs->fetch_assoc();
                                                ?>

                                                <td class="center">0 <?php echo $invoice_data["id"]; ?></td>
                                                <td class="left"><?php echo $oid; ?></td>
                                                <td class="left"><?php echo $product_data["title"]; ?></td>
                                                <td class="center"><?php echo $invoice_data["qty"]; ?></td>
                                                <td class="right">Rs. <?php echo $product_data["price"]; ?></td>
                                                <td class="right">Rs. <?php echo $invoice_data["total"]; ?></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-sm-5">Visit newtech.lk for the return policy.</div>
                                    <div class="col-lg-4 col-sm-5 ml-auto">
                                        <table class="table table-clear">
                                            <tbody>
                                                <?php
                                                $city_rs = Database::search("SELECT * FROM `city` WHERE `city_id`= '" . $address_data["city_city_id"] . "'");
                                                $city_data = $city_rs->fetch_assoc();

                                                $delivery = 0;
                                                if ($city_data["district_district_id"] == 1) {
                                                    $delivery = $product_data["delivery_fee_colombo"];
                                                } else {
                                                    $delivery = $product_data["delivery_fee_other"];
                                                }

                                                $t = $invoice_data["total"];
                                                $g = $t + $delivery;


                                                ?>
                                                <tr>
                                                    <td class="left">
                                                        <strong>Total</strong>
                                                    </td>
                                                    <td class="right">Rs. <?php echo $t; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="left">
                                                        <strong>Delivery Cost</strong>
                                                    </td>
                                                    <td class="right">Rs. <?php echo $delivery; ?></td>
                                                </tr>
                                                <!-- <tr>
                                                    <td class="left">
                                                        <strong>VAT (10%)</strong>
                                                    </td>
                                                    <td class="right">$679,76</td>
                                                </tr> -->
                                                <tr>
                                                    <td class="left">
                                                        <strong>Grand Total</strong>
                                                    </td>
                                                    <td class="right">
                                                        <strong>Rs. <?php echo $g; ?></strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-danger-subtle">
                            <label class="form-label fs-5 text-danger fw-bold text-center justify-content-center d-flex">
                                Transaction was successful.<br>
                                Thank you.
                        </label>

                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>




            <?php include "footer.php"; ?>
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>