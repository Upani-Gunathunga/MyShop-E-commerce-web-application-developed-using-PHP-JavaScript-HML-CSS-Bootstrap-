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

<body class="main-body bg-transparent">

    <div class="container-fluid">

        <div class="row">
            <?php include  "header.php"; ?>
            <!-- require "header.php" -->

            <hr />

            <div class="col-12 justify-content-center">
                <div class="row mb-3">
                    <div class="offset-3 offset-lg-1 col-4 col-lg-1 logo" style="height: 60px;"></div>

                    <div class="col-12 col-lg-6">
                      

                        <div class="input-group mb-3 mt-3">
                            <input type="text" class="form-control" id="kw" aria-label="Text input with dropdown button">

                            <select class="form-select" id="c" style="max-width: 250px;">

                                <option value="0">All Categories</option>

                                <?php

                                $category_rs = Database::search("SELECT * FROM `category`");
                                $category_num = $category_rs->num_rows;

                                for ($x = 0; $x < $category_num; $x++) {
                                    $category_data = $category_rs->fetch_assoc();

                                ?>
                                    <option value="<?php echo $category_data["cat_id"]; ?>">
                                        <?php echo $category_data["cat_name"] ?>
                                    </option>
                                <?php

                                }

                                ?>


                                <!-- <option value="1">Smart Phones</option>
                                <option value="2">Laptops</option>
                                <option value="3">Cameras</option>
                                <option value="4">Drones</option> -->

                            </select>

                        </div>
                        <div class="col-12 col-lg-2 mt-2 mt-lg-2 text-center text-lg-start">
                        <a href="advancedSearch.php" class="text-decoration-none link-secondary fw-bold">Advanced Search</a>
                    </div>


                    </div>


                    <div class="col-12 col-lg-2 d-grid">
                        <button class="btn btn-danger mt-3 mb-3" onclick="basicSearch(0);">Search

                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                        </button>
                        

                    </div>

                  

                </div>

            </div>

            <hr />

            <div class="col-12" id="basicSearchResult">
                <div class="row">




                    <?php

                    $c_rs = Database::search("SELECT * FROM `category`");
                    $c_num = $c_rs->num_rows;

                    for ($y = 0; $y < $c_num; $y++) {
                        $c_data = $c_rs->fetch_assoc();

                    ?>

                        <!-- category names -->

                        <div class="col-12 mt-3 mb-3 text-uppercase text-center ">

                            <h4>
                                <?php echo $c_data["cat_name"];  ?>
                            </h4>&nbsp;&nbsp;


                        </div>

                        <!-- category names  -->
                        <!-- products -->

                        <div class="col-12 mb-3">
                            <div class="row border border-danger">
                                <div class="col-12">
                                    <div class="row justify-content-center gap-5">

                                        <?php

                                        $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `condition` ON 
                                        product.condition_condition_id = condition.condition_id WHERE 
                                    `category_cat_id`='" . $c_data['cat_id'] . "' AND `status_status_id`='1' ");

                                        $product_num = $product_rs->num_rows;
                                        for ($x = 0; $x < $product_num; $x++) {

                                            $product_data = $product_rs->fetch_assoc();

                                        ?>

                                            <div class="card bg-danger-subtle " style="width: 18rem;">

                                                <?php

                                                $img_rs = Database::search(" SELECT * FROM `product_img` WHERE  
`product_id`='" . $product_data['id'] . "' ");

                                                $img_data = $img_rs->fetch_assoc();

                                                ?>

                                                <img src="<?php echo $img_data["img_path"]; ?>" class="card-img-top" style="height: 180px;">
                                                <div class="card-body ms-0 m-0 text-center d-flex-fill " style="height: max-content;">
                                                    <h5 class="card-title"><?php echo $product_data["title"]; ?></h5>

                                                </div>
                                                <ul class="list-group list-group-flush text-center">
                                                    <li class="list-group-item">
                                                        <!-- <p style="text-decoration: line-through;">Price: Rs.300,000.000</p> -->
                                                        <p style="color: crimson;">Rs. <?php echo $product_data["price"]; ?> </p>
                                                    </li>

                                                    <li class="list-group-item">Condition: <?php echo $product_data["condition_name"]; ?></li>
                                                    <li class="list-group-item">Qty: <?php echo $product_data["qty"]; ?> In stock</li>

                                                </ul>
                                                <button class="col-12 btn btn-dark mt-2" onclick="addToCart(<?php echo $product_data['id']; ?>);"><i class="bi bi-cart4 text-white fs-5"></i>Add to Cart</button>
                                                <button onclick="addToWatchlist(<?php echo $product_data['id']; ?>);" class="col-12 btn btn-dark mt-2 border-primary">
                                                    <i class="bi bi-heart-fill text-light fs-5"></i>Add to Watchlist
                                                </button>
                                                <div class="card-body text-center">
                                                    <a href="<?php echo "singleProductView.php?id=".($product_data["id"]); ?>" class="card-link">View Full details</a><br>
                                                    <a class="col-12 btn btn-outline-danger" href="<?php echo "singleProductView.php?id=" . ($product_data["id"]); ?>">Buy Now</a>
                                                </div>
                                            </div>


                                        <?php

                                        }


                                        ?>



                                    </div>

                                </div>

                            </div>

                        </div>
                        <!-- products -->


                    <?php


                    }

                    ?>

                </div>

            </div>

            <?php include  "footer.php"; ?>


        </div>

    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="bootstrap.bundle.min.js"></script>

    <script src="script.js"></script>
</body>



</html>