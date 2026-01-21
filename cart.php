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
                <!-- <div class="col-12 bg-body mb-2">
               
            </div>  -->
                <?php include "header.php"; ?>
                <!--breadcrumb-->
                <div class="col-12 pt-2 bg-opacity-75 bg-danger-subtle">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                        </ol>
                    </nav>
                </div>
                <!--breadcrumb-->
                <div class="col-12" style="height: 200px;">

                </div>
                <?php

                if (isset($_SESSION["u"])) {

                    $user = $_SESSION["u"]["email"];

                    $total = 0;
                    $subtotal = 0;
                    $shipping = 0;
                    // signed users
                ?>
                    <div class="col-12 text-center">
                        <label class="form-label fs-1 fw-bold text-center">Find your Cart Items Here <i class="bi bi-cart4 fs-1 text-danger"></i></label>

                    </div>
                    <hr class="bg-danger-subtle">
                    <div class="col-12">
                        <div class="row">
                            <div class="offset-lg-1 col-12 col-lg-8 mb-3">
                                <input type="text" class="form-control" placeholder="Search in Cart..." />
                            </div>
                            <div class="col-12 col-lg-2 mb-3 d-grid">
                                <button class="btn btn-outline-primary">Search</button>
                            </div>
                        </div>
                    </div>

                    <?php

                    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `users_email` = '" . $user . "'");
                    $cart_num = $cart_rs->num_rows;

                    if ($cart_num == 0) {
                        # empty view code...
                    ?>
                        <div class="card mb-3 w-75 bg-dark border-danger p-2 col-md-8 offset-md-1 bg-opacity-50">
                            <div class="row g-0">
                                <div class="col-md-8 offset-2 justify-content-center d-flex">
                                    <h1 class="text-center">&#9785;</h1><br>
                                    <h1>Oops!</h1>
                                </div>
                                <div class="col-md-8 offset-2">
                                    <div class="card-body">
                                        <div class="col-md-8 offset-2 text-center">
                                            <label class="form-label fs-1 fw-bold">You have no items in your cart yet.</label>
                                        </div>
                                        <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                            <a href="home.php" class="btn btn-danger fs-3 fw-bold">Start Shopping in newtech</a>
                                        </div>
                                    </div>
                                </div>





                            </div>
                        </div>
                    <?php
                    } else {
                        # product code...
                    ?>
                        <!--main content start-->
                        <section class="h-100 gradient-custom">
                            <div class="container py-5">
                                <div class="row d-flex justify-content-center my-4">
                                    <div class="col-md-8">
                                        <div class="card mb-4">
                                            <div class="card-header py-3">
                                                <h5 class="mb-0">Number of items in the Cart - <?php echo $cart_num; ?> </h5>
                                            </div>
                                        </div>

                                        <?php

                                        for ($x = 0; $x < $cart_num; $x++) {

                                            $cart_data = $cart_rs->fetch_assoc();
                                            $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `condition` ON 
                                       condition.condition_id=product.condition_condition_id INNER JOIN `color` ON 
                                       color.clr_id=product.color_clr_id  INNER JOIN `product_img` ON 
                                       product_img.product_id=product.id WHERE 
                                       `id`= '" . $cart_data["product_id"] . "' ");

                                            $product_data = $product_rs->fetch_assoc();

                                            $total = $total + ($product_data["price"] * $cart_data["qty"]);

                                            $address_rs = Database::search(" SELECT district.district_id AS `did` FROM 
                                           `users_has_address` INNER JOIN `city` ON 
                                          users_has_address.city_city_id = city.city_id INNER JOIN `district` ON 
                                          district.district_id= city.district_district_id WHERE 
                                           `users_email`='" . $user . "' ");

                                            $address_data = $address_rs->fetch_assoc();

                                            $ship = 0;

                                            if ($address_data["did"] == 1) {
                                                $ship = $product_data["delivery_fee_colombo"];
                                                $shipping = $shipping + $product_data["delivery_fee_colombo"];
                                            } else {
                                                $ship = $product_data["delivery_fee_other"];
                                                $shipping = $shipping + $product_data["delivery_fee_other"];
                                            }
                                            $subtotal = $shipping + $total;

                                            $seller_rs = Database::search("SELECT * FROM `users` WHERE 
                                              `email`='" . $product_data["users_email"] . "' ");
                                            $seller_data = $seller_rs->fetch_assoc();
                                            $seller = $seller_data["fname"] . " " . $seller_data["lname"];

                                        ?>

                                            <div class="card mb-4">
                                                <div class="card-header py-3">
                                                    <h5 class="mb-0 text-danger"><?php echo $product_data["title"]; ?></h5>
                                                </div>
                                                <div class="card-body">


                                                    <hr class="my-4" />

                                                    <!-- Single item -->
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                                                            <!-- Image -->
                                                            <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                                                                <img src="<?php echo $product_data["img_path"]; ?>" class="w-100" />
                                                                <a href="#!">
                                                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                                                                </a>
                                                            </div>
                                                            <!-- Image -->
                                                        </div>

                                                        <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                                                            <!-- Data -->
                                                            <p><strong><?php echo $product_data["description"]; ?></strong></p>
                                                            <p>Seller: <?php echo $seller; ?></p>
                                                            <p>Colour : <?php echo $product_data["clr_name"]; ?></p>
                                                            <p>Condition : <?php echo $product_data["condition_name"]; ?></p>



                                                            <button type="button" class="btn btn-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="Remove item" onclick="removeFromCart(<?php echo $cart_data['cart_id'];  ?>)">
                                                                <i class="bi bi-trash3"></i>
                                                            </button>
                                                            <button type="button" class="btn btn-danger btn-sm mb-2" data-mdb-toggle="tooltip" title="Move to the wish list" onclick="addToWatchlist(<?php echo $product_data['id']; ?>);">
                                                                <i class="bi bi-heart"></i>
                                                            </button>
                                                            <!-- Data -->
                                                        </div>

                                                        <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                                                            <!-- Quantity -->
                                                            <div class="d-flex mb-4" style="max-width: 300px">
                                                                <button class="btn btn-primary px-3 me-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                                    <i class="bi bi-dash-circle"></i>
                                                                </button>

                                                                <div class="form-outline">
                                                                    <input id="form1" min="0" name="quantity" value="1" type="number" class="form-control" />
                                                                    <label class="form-label" for="form1">Quantity</label>
                                                                </div>

                                                                <button class="btn btn-primary px-3 ms-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                                    <i class="bi bi-plus-circle"></i>
                                                                </button>
                                                            </div>
                                                            <!-- Quantity -->

                                                            <!-- Price -->
                                                            <p class="text-start text-md-center">

                                                                <strong>Price : Rs. <?php echo $product_data["price"]; ?></strong>
                                                            </p>
                                                            <!-- Price -->
                                                        </div>
                                                    </div>
                                                    <!-- Single item -->
                                                </div>
                                            </div>




                                        <?php
                                        }

                                        ?>
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <p><strong>Expected shipping delivery</strong></p>
                                                <p class="mb-0">within one week time period of placing the order</p>
                                            </div>
                                        </div>

                                        <div class="card mb-4 mb-lg-0">
                                            <div class="card-body flex-fill d-inline-flex">
                                                <p><strong>We accept &nbsp; &nbsp;</strong></p>
                                                <img class="me-2" width="45px" src="resources/payment method images/visa_img.png" alt="Visa" />
                                                <img class="me-2" width="45px" src="resources/payment method images/american_express_img.png" alt="American Express" />
                                                <img class="me-2" width="45px" src="resources/payment method images/mastercard_img.png" alt="Mastercard" />
                                                <img class="me-2" width="45px" src="resources/payment method images/paypal_img.png" alt="PayPal acceptance mark" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card mb-4">
                                            <div class="card-header py-3">
                                                <h5 class="mb-0">Summary</h5>
                                            </div>
                                            <div class="card-body">
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                                        Products(<?php echo $cart_num; ?>)
                                                        <span>Rs. <?php echo $total; ?></span>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                                        Shipping
                                                        <span><?php echo $shipping; ?></span>
                                                    </li>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                                        <div>
                                                            <strong>Total amount</strong>
                                                            <strong>
                                                                <p class="mb-0">(including VAT)</p>
                                                            </strong>
                                                        </div>
                                                        <span><strong>Rs. <?php echo $subtotal; ?></strong></span>
                                                    </li>
                                                </ul>

                                                <button type="button" class="btn btn-primary btn-lg btn-block">
                                                    Go to checkout
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!--main content end-->
                    <?php
                    }


                    ?>

                <?php
                    // signed users


                } else {
                    // unsigned users
                ?>

                    <div class=" col-12 vh-100 border-end border border-warning align-items-center d-flex justify-content-center">
                        <h1 class="text-center">&#9785;</h1><br>
                        <h1 class="text-center text-opacity-25 text-danger-emphasis">Please log in to view your items in the cart.</h1>

                    </div>

                <?php
                    // unsigned users


                }

                ?>











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

<?php



?>