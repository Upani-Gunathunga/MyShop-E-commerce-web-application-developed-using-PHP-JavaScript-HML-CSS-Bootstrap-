<?php
session_start();
require "connection.php";

?>


<!DOCTYPE html>
<html>

<head>
    <link rel="icon" href="resources/newtech logo.png" />
    <title>New Tech</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="bootstrap.css" />

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


</head>

<body>

    <div class="container-fluid main-body">

        <div class="row">
            <?php include  "header.php"; ?>
            <!-- require "header.php" -->

            <hr />
            <div style="height: 100px;"></div>


            <div class="col-12 justify-content-center ">

                <div class="bg-body-tertiary p-5 rounded">
                    <h1>Welcome to New Tech online store</h1>
                    <p class="lead">
                        New Tech is a leading quality and branded electronic items shop and we provide 24 hour efficients ervice to our valuable customers.<br />Now we are just one click away from you.
                    </p>
                    <a class="btn btn-lg btn-danger" href="http://localhost/myshopproject/myProducts.php" role="button">See our products here>></a>
                </div>

            </div>
            <hr class="m-3 bg-danger">


            <div id="carouselExampleDark" class="carousel carousel-dark slide col-10 offset-1">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="10000">
                        <img src="resources/assignment 1img1.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>24 HOURS ACTIVE</h5>
                            <p>We provideour best service</p>
                        </div>
                    </div>
                    <div class="carousel-item" data-bs-interval="2000">
                        <img src="resources/assignment 1img2.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>We assure to deliver quality electronic products</h5>
                            <p>Our products are with high quality</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="resources/background-body.svg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Sign Up if you are new to here</h5>
                            <p>You have a lot of advantages</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <div style="height: 10px;"></div>




            <main>

                <h1 class="text-body-secondary text-decoration-underline text-center">

                    <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-emoji-smile spinner-grow" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path d="M4.285 9.567a.5.5 0 0 1 .683.183A3.498 3.498 0 0 0 8 11.5a3.498 3.498 0 0 0 3.032-1.75.5.5 0 1 1 .866.5A4.498 4.498 0 0 1 8 12.5a4.498 4.498 0 0 1-3.898-2.25.5.5 0 0 1 .183-.683zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5z" />
                    </svg> -->
                    &blacktriangledown;Top Selling Items
                </h1>
                <br>
                <?php

                $recent_rs = Database::search("SELECT DISTINCT product.id,product.price,product.title,product.description,product_img.img_path  FROM `invoice` INNER JOIN `product` ON 
                product.id=invoice.product_id INNER JOIN `product_img` ON 
                product.id=product_img.product_id  LIMIT 6");



                $recent_num = $recent_rs->num_rows;
                for ($y = 0; $y < $recent_num; $y++) {
                    $recent_data = $recent_rs->fetch_assoc();

                ?>
                    <div class="row row-cols-1 row-cols-md-3 text-center d-grid d-flex justify-content-center">
                        <div class="col-12 p-3 justify-align-content-center">
                            <div class="col-12 card rounded-3 shadow-sm p-4 flex-column">
                                <div class="card-header ">
                                    <p><?php echo $recent_data["title"];  ?>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <button class="btn" onclick="addToWatchlist(<?php echo $product_data['id']; ?>);"></button>
                                    </p>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <p><img src="<?php echo $recent_data["img_path"];  ?>" class="hplap"></p>
                                        </div>

                                    </div>
                                </div>
                                <div class="card-footer">

                                    <p>
                                        <?php echo $recent_data["description"];  ?>
                                    </p>
                                    <p>
                                        <?php
                                         $c_rs = Database::search("SELECT * FROM `category`");
                                         $c_num = $c_rs->num_rows;
                     
                                         
                                             $c_data = $c_rs->fetch_assoc();
                                        $sold_rs = Database::search("SELECT * FROM `invoice` WHERE 
                                   `product_id`= $recent_data[id] ");

                                        $sold_num = $sold_rs->num_rows;
                                        $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `condition` ON 
                                        product.condition_condition_id = condition.condition_id WHERE 
                                    `category_cat_id`='" . $c_data['cat_id'] . "' AND `status_status_id`='1' ");

                                        $product_num = $product_rs->num_rows;
                                       

                                            $product_data = $product_rs->fetch_assoc();
                                        ?>
                                        <button class="btn btn-outline-danger href="<?php echo "singleProductView.php?id=" . ($product_data['id']); ?>>
                                            Buy it now
                                        </button><br>Rs. <?php echo $recent_data["price"];  ?><br>
                                        <?php echo $sold_num;  ?> items sold


                                    </p>
                                </div>
                            </div>
                        </div>



                    </div>

                <?php

                }

                ?>


            </main>

            <hr />



            <?php include  "footer.php"; ?>


        </div>

    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="bootstrap.bundle.min.js"></script>

    <script src="script.js"></script>
</body>



</html>