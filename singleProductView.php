<?php
session_start();
require "connection.php";

if (isset($_GET["id"])) {
    $pid = $_GET["id"];
    $user = $_SESSION["u"];

    $product_rs = Database::search("SELECT product.id,product.price,product.qty,product.description,
    product.title,product.datetime_added,product.delivery_fee_colombo,
    product.delivery_fee_other,product.category_cat_id,product.model_has_brand_id,
    product.color_clr_id,product.status_status_id,product.condition_condition_id,
    product.users_email,model.model_name AS mname,brand.brand_name AS bname ,
    color.clr_name,condition.condition_name,users.fname,users.lname,users.email
    FROM `product` INNER JOIN `model_has_brand` ON 
    model_has_brand.id=product.model_has_brand_id INNER JOIN `brand` ON 
    brand.brand_id=model_has_brand.brand_brand_id INNER JOIN `model` ON 
    model.model_id=model_has_brand.model_model_id  INNER  JOIN `color` ON 
	 color.clr_id=product.color_clr_id INNER JOIN `condition` ON 
	 `condition`.condition_id=product.condition_condition_id INNER JOIN 
	 `users` ON users.email=product.users_email WHERE product.id='" . $pid . "'");

    $product_num = $product_rs->num_rows;

    if ($product_num == 1) {
        $product_data = $product_rs->fetch_assoc();

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
                    <div class="col-12 bg-body mb-2">
                        <?php include "header.php"; ?>
                    </div>
                    <div class="col-12" style="height: 200px;">

                    </div>


                    <!-- PAGE START-->
                    <h1 class="title"><?php echo $product_data["title"]; ?></h1>
                    <?php
                    $price = $product_data["price"];
                    $add = ($price / 100) * 10;
                    $new_price = $price + $add;
                    $diff = $new_price - $price;
                    $percent = ($diff / $price) * 100;

                    ?>
                    <div class="col-12 container-fluid">
                        <div class="row g-4">

                            <?php

                            $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $pid . "'");
                            $img_num = $img_rs->num_rows;
                            $img_list = array();
                            if ($img_num != 0) {
                                for ($x = 0; $x < $img_num; $x++) {
                                    $img_data = $img_rs->fetch_assoc();
                                    $img_list[$x] = $img_data["img_path"];

                            ?>

                                    <div class="col-12 col-md-4 align-items-center d-flex">
                                        <div class="card text-center w-100 " id="mainImg">
                                            <img src="<?php echo $img_list[$x];  ?>" style="height: 600px; background-position: center; " class="mt-5" id="product_img">
                                        </div>
                                    </div>


                                <?php
                                }
                            } else {
                                ?>
                                <li class="d-flex flex-column justify-content-center align-items-center 
            border border-1 border-secondary mb-1">
                                    <img src="resources/addproductimg.svg" class="img-thumbnail mt-1 mb-1" />
                                </li>
                                <li class="d-flex flex-column justify-content-center align-items-center 
            border border-1 border-secondary mb-1">
                                    <img src="resources/addproductimg.svg" class="img-thumbnail mt-1 mb-1" />
                                </li>
                                <li class="d-flex flex-column justify-content-center align-items-center 
            border border-1 border-secondary mb-1">
                                    <img src="resources/addproductimg.svg" class="img-thumbnail mt-1 mb-1" />
                                </li>

                            <?php
                            }

                            ?>


                            <div class="col-12 col-md-4 align-items-center d-flex">
                                <div class="card text-center w-100 ">
                                    <div class="card-header">
                                        <p class="p1"><?php echo $product_data["description"]; ?></p>

                                        <p style="color: brown;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-fire" viewBox="0 0 16 16" style="color: brown;">
                                                <path d="M8 16c3.314 0 6-2 6-5.5 0-1.5-.5-4-2.5-6 .25 1.5-1.25 2-1.25 2C11 4 9 .5 6 0c.357 2 .5 4-2 6-1.25 1-2 2.729-2 4.5C2 14 4.686 16 8 16Zm0-1c-1.657 0-3-1-3-2.75 0-.75.25-2 1.25-3C6.125 10 7 10.5 7 10.5c-.375-1.25.5-3.25 2-3.5-.179 1-.25 2 1 3 .625.5 1 1.364 1 2.25C11 14 9.657 15 8 15Z" />
                                            </svg>&nbsp; &nbsp; only <?php echo $product_data["qty"]; ?> in stock
                                        </p>

                                    </div>
                                    <div class="card-body">

                                        <!-- <p class="card-text">


                                        <p class="text-body-secondary">This has an attractive appearance with a long battery life and a high
                                            quality camera.</p>
                                        Condition: Brand New<br>

                                        </p>


                                        <div class="input-group col-12">
                                            <label class="col-6">Storage capacity</label>
                                            <select class="form-select col-6" id="inputGroupSelect04" aria-label="Example select with button addon">
                                                <option selected>Choose...</option>
                                                <option value="1">100GB</option>
                                                <option value="2">300GB</option>
                                                <option value="3" disabled>600GB(Not available now)</option>
                                            </select>


                                        </div> -->
                                        <br>

                                        <br>
                                        <!-- Quantity -->
                                        <div class="d-flex mb-4 col-12 offset-2">
                                            <button class="btn btn-danger px-3 me-2" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                <i class="bi bi-dash-circle"></i>
                                            </button>

                                            <div class="form-outline">
                                                <input max="<?php echo $product_data['qty']; ?>" min="1" name="quantity" value="1" type="number" class="form-control" onkeyup='check_value(<?php echo $product_data["qty"]; ?>);' id="qty_input" />
                                                <label class="form-label" for="qty_input">Quantity</label>
                                            </div>

                                            <button class="btn btn-danger px-3 ms-2" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                <i class="bi bi-plus-circle"></i>
                                            </button>
                                        </div>
                                        <!-- Quantity -->
                                        <br>
                                        <h3 class="text-warning-emphasis">Unit Price: <?php echo $product_data["price"]; ?></h3>
                                        <h3 class="text-warning-emphasis">Seller Name: <?php echo $product_data["fname"] . " " . $product_data["lname"]; ?></h3>
                                        <h3 class="text-warning-emphasis"> Seller's email: <?php echo $product_data["users_email"]; ?></h3>

                                        <h3 class="text-warning-emphasis"> Brand: <?php echo $product_data["bname"]; ?></h3>
                                        <h3 class="text-warning-emphasis"> Color: <?php echo $product_data["clr_name"]; ?></h3>
                                        <h3 class="text-warning-emphasis"> Model: <?php echo $product_data["mname"]; ?></h3>
                                        <h3 class="text-warning-emphasis"> Condition: <?php echo $product_data["condition_name"]; ?></h3>

                                        <p>&check;100% Functional<br>
                                            &checkmark; Good performance <br>


                                            &check;12 Month Loop Warranty
                                        </p>



                                        <button class="btn btn-danger" type="submit" id="payhere-payment" onclick="paynow(<?php echo $pid; ?>);">Pay Now</button>
                                        <a href="#" class="btn btn-outline-danger" onclick="addToCart(<?php echo $product_data['id']; ?>);">Add to cart</a>
                                        <a href="#" class="btn btn-outline-danger" onclick="addToWatchlist(<?php echo $product_data['id']; ?>);">&hearts;Add to Watchlist</a>


                                    </div>
                                    <div class="card-footer text-body-secondary">
                                        last order 20 minutes ago
                                    </div>
                                </div>

                            </div>
                            <?php
                            $recent_rs = Database::search("SELECT DISTINCT * FROM `invoice` INNER JOIN `product` ON 
                             product.id=invoice.product_id INNER JOIN `product_img` ON 
                             product.id=product_img.product_id LIMIT 6");


                            $recent_num = $recent_rs->num_rows;
                            $recent_data = $recent_rs->fetch_assoc();
                            $sold_rs = Database::search("SELECT  `product_id` FROM `invoice`  WHERE `product_id`='".$pid."'");
                              $sold_num = $sold_rs->num_rows;
                              
                            

                            ?>
                            <div class="col-12 col-md-4 align-items-center d-flex fw-bolder">
                                <ul class="list-group w-100">
                                    <li class="list-group-item">
                                        <h3 class="text-center">&star;&star;&star;</h3>
                                    </li>

                                    <li class="list-group-item list-group-item-primary">
                                        <h6>Number of Items Sold</h6>
                                        <p><?php echo $sold_num;  ?></p>
                                    </li>
                                    <li class="list-group-item list-group-item-secondary">
                                        <h6 class="text-danger">New Price</h6>
                                        <p><?php echo $price; ?></p>
                                    </li>
                                    <li class="list-group-item list-group-item-success">
                                        <h6> Price</h6>
                                        <p class="text-decoration-line-through "><?php echo $new_price; ?></p>
                                    </li>
                                    <li class="list-group-item list-group-item-danger">
                                        <h6>Discount</h6>
                                        <p><?php echo $percent; ?>%</p>
                                    </li>
                                    <li class="list-group-item list-group-item-warning">
                                        <h6>Today Promotions</h6>
                                        <p>Not available</p>
                                    </li>
                                    <!-- <li class="list-group-item list-group-item-info">
                                        <h6>Latest features</h6>
                                        <p>Face recognition</p>
                                    </li>
                                    <li class="list-group-item list-group-item-light">
                                        <h6>Style</h6>
                                        <p>Touch Screen</p>
                                    </li>
                                    <li class="list-group-item list-group-item-dark">
                                        <h6>Processor</h6>
                                        <p>Hexa Core</p>
                                    </li> -->
                                </ul>

                            </div>
                            <!--Related Items-->
                            <div class="col-12 bg-danger bg-opacity-75">
                                <div class="row d-block me-0 mt-4 mb-3 border-bottom border-1 border-dark text-center">
                                    <div class="col-12">
                                        <span class="fs-3 fw-bold">Related Items</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 bg-transparent opacity-50 ">
                                <div class="row g-1">
                                    <?php
                                    $related_rs = Database::search("SELECT * FROM `product` WHERE 
                            `model_has_brand_id` = '" . $product_data["model_has_brand_id"] . "' LIMIT 4 ");

                                    $related_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` IN (SELECT `id` FROM `product` WHERE 
                             `model_has_brand_id`= '" . $product_data["model_has_brand_id"] . "')");

                                    $related_num = $related_rs->num_rows;
                                    $related_img_num = $related_img_rs->num_rows;


                                    for ($x = 0; $x < $related_num; $x++) {
                                        $related_data = $related_rs->fetch_assoc();
                                        $related_img_data = $related_img_rs->fetch_assoc();


                                    ?>

                                        <div class="col-12 col-md-3 g-1">
                                            <div class="card" style="width: 18rem;">

                                                <img src="<?php echo $related_img_data["img_path"]; ?>" class="card-img-top" style="height: 180px;">
                                                <div class="card-body ms-0 m-0 text-center d-flex-fill " style="height: max-content;">
                                                    <h5 class="card-title"><?php echo $related_data["title"]; ?></h5>

                                                </div>
                                                <ul class="list-group list-group-flush text-center">
                                                    <li class="list-group-item">
                                                        <!-- <p style="text-decoration: line-through;">Price: Rs.300,000.000</p> -->
                                                        <p style="color: crimson;">Rs. <?php echo $related_data["price"]; ?> </p>
                                                    </li>


                                                    <li class="list-group-item">Qty: <?php echo $related_data["qty"]; ?> In stock</li>

                                                </ul>
                                                <button class="col-12 btn btn-dark mt-2" onclick="addToCart(<?php echo $product_data['id']; ?>);"><i class="bi bi-cart4 text-white fs-5"></i>Add to Cart</button>
                                                <button onclick="addToWatchlist(<?php echo $product_data['id']; ?>);" class="col-12 btn btn-dark mt-2 border-primary">
                                                    <i class="bi bi-heart-fill text-light fs-5"></i>Add to Watchlist
                                                </button>
                                                <div class="card-body text-center">
                                                    <a href="<?php echo "singleProductView.php?id=" . ($product_data["id"]); ?>" class="card-link">View Full details</a><br>
                                                    <a class="col-12 btn btn-outline-danger" href="<?php echo "singleProductView.php?id=" . ($product_data["id"]); ?>">Buy Now</a>
                                                </div>
                                            </div>
                                        </div>

                                    <?php
                                    }

                                    ?>
                                </div>
                            </div>
                            <!--Related Items-->
                            <!--feedback-->

                            <!--feedback-->

                        </div>
                    </div>
                    <!-- PAGE END-->

                </div>
                <div class="col-12 mx">
                    <?php include "footer.php"; ?>


                </div>

            </div>



            <script src="bootstrap.bundle.js"></script>
            <script src="script.js"></script>
            <script src="bootstrap.bundle.min.js"></script>
            <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
        </body>

        </html>
    <?php

    } else {
    ?>
        <script>
            alert("Something went wrong.");
        </script>
<?php
    }
}




?>