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
            <div class="col-12 bg-body mb-2">
                <?php include "header.php"; ?>
            </div>
            <div class="col-12" style="height: 200px;">

            </div>
            <?php

            if (isset($_SESSION["u"])) {
                // signed users
            ?>
            <!--content PAGE START-->

            <h1 class="text-center text-opacity-25 text-danger-emphasis">My Watchlist</h1>
            <div class="col-12 justify-content-center d-flex">

                <div class="input-group mb-3">
                    <select class="form-select" id="inputGroupSelect04" aria-placeholder="bh">
                        <option selected>All</option>
                        <option value="1">Laptops</option>
                        <option value="2">Phones</option>
                        <option value="3">Gaming</option>
                        <option value="4">Internet connection</option>
                        <option value="5">Digital Watches</option>
                        <option value="6">Gadgets</option>

                    </select>
                    <input type="text" class="form-control" placeholder="search in watchlist">
                    <button class="btn btn-outline-danger" type="button">Search</button>
                </div>



            </div>

            <?php

            $watchlist_rs = Database::search("SELECT * FROM `watchlist` INNER JOIN `product` ON 
            product.id=watchlist.product_id INNER JOIN `condition` ON 
             condition.condition_id=product.condition_condition_id INNER JOIN `color` ON 
              color.clr_id=product.color_clr_id  INNER JOIN `product_img` ON 
                product_img.product_id=product.id INNER JOIN `users` ON 
              users.email=product.users_email WHERE 
               watchlist.users_email='" . $_SESSION["u"]["email"] . "' ");
            $watchlist_num = $watchlist_rs->num_rows;

            if ($watchlist_num == 0) {
            ?>
                <!-- empty view -->
                <div class="card mb-3 w-75 bg-dark border-danger p-2 col-md-8 offset-md-1 bg-opacity-50">
                    <div class="row g-0">
                        <div class="col-md-8 offset-2 justify-content-center d-flex">
                            <h1 class="text-center">&#9785;</h1><br>
                            <h1>Oops!</h1>
                        </div>
                        <div class="col-md-8 offset-2">
                            <div class="card-body">
                                <div class="col-md-8 offset-2 text-center">
                                    <label class="form-label fs-1 fw-bold">You have no items in your Watchlist yet.</label>
                                </div>
                                <div class="offset-lg-4 col-12 col-lg-4 d-grid mb-3">
                                    <a href="home.php" class="btn btn-danger fs-3 fw-bold">Start Shopping in newtech</a>
                                </div>
                            </div>
                        </div>





                    </div>
                </div>
                <!-- empty view -->
                <?php
            } else {
                for ($x = 0; $x < $watchlist_num; $x++) {
                    $watchlist_data = $watchlist_rs->fetch_assoc();
                ?>
                    <!-- have products -->
                    <div class="col-12 ">
                        <div class="row justify-content-center d-flex">

                            <div class="card mb-3 w-75 bg-dark border-danger p-2 col-12 bg-opacity-50">
                                <div class="row g-0">
                                    <div class="col-md-4 justify-content-center d-flex">
                                        <img src="<?php echo $watchlist_data["img_path"];  ?>" class="img-fluid rounded-start">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <div class="col-12 text-center">

                                                <h5 class="card-title" style="color: moccasin;"><?php echo $watchlist_data["title"];  ?></h5>
                                                <p class="card-text text-white ">
                                                    color: <?php echo $watchlist_data["clr_name"];  ?><br>
                                                    condition: <?php echo $watchlist_data["condition_name"];  ?><br>
                                                    Price: Rs. <?php echo $watchlist_data["price"];  ?><br>
                                                    <?php echo $watchlist_data["qty"];  ?> in Stock<br>
                                                    Seller: <?php echo $watchlist_data["fname"] . " " . $watchlist_data["lname"];  ?>
                                                </p>
                                                <p class="card-text"><small class="text-light">Last view few seconds ago</small></p>
                                            </div>

                                            <a class="btn btn-success col-12 m-1 " href="<?php echo "singleProductView.php?id=" . ($watchlist_data['id']); ?>">Buy Now</a>
                                            <button class="btn btn-primary col-12 m-1" onclick="addToCart(<?php echo $watchlist_data['id']; ?>);">Add to cart</button>
                                            <button class="btn btn-danger col-12 m-1" onclick="removeFromWatchlist(<?php echo $watchlist_data['id']; ?>);">Remove</button>
                                        </div>
                                    </div>





                                </div>
                            </div>


                        </div>

                    </div>
                    <!-- have products -->
            <?php
                }
            }



            ?>
            <?php
                    // signed users


                } else {
                    // unsigned users
                    ?>

                    <div class=" col-12 vh-100 border-end border border-warning align-items-center d-flex justify-content-center">
                    <h1 class="text-center">&#9785;</h1><br>
                    <h1 class="text-center text-opacity-25 text-danger-emphasis">Please log in to view your items in watchlist.</h1>

                    </div>
                     
                    <?php
                        // unsigned users


                    }

                        ?>
            

        </div>
    </div>
    <!--HOME PAGE END-->
    








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