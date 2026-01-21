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

            <div class="col-12 bg-body mb-2">
                <div class="row">
                    <div class=" col-12 ">
                        <div class="row">
                            
                            <div class="col-12 text-center">
                                <P class="fs-1 text-text-danger-emphasis fw-bold mt-3 pt-2 text-text-center">My Products</P>
                                <div class="col-12 col-lg-2 mx-2 mb-2 my-lg-4 mx-lg-0 d-grid text-text-center">
                                    <button class="btn btn-outline-danger fw-bold " onclick="window.location='addProduct.php'">+ Add Product</button>
                                </div>
                               
                            </div>
                            
                            <div class="col-12">
                                <hr class="border border-3 border-danger">
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <div class=" left  mb-3  border-end bg-body rounded">
                <div class="row">

                    <div class=" col-12 ">
                        <div class="row">
                            <div class="col-12 col-lg-10 mt-2 mb-1">
                                <input type="text" class="form-control" placeholder="Type keyword to search..." id="t" />
                            </div>
                            <div class="col-12 col-lg-2 mt-2 mb-1 d-grid">
                                <button class="btn btn-danger" onclick="advancedSearch2(0);">Search</button>
                            </div>
                            <div class="col-12">
                                <hr class="border border-3 border-danger">
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">

                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12  mb-3">
                                        <select class="form-select" id="c1">
                                            <option value="0">Select Category</option>

                                            <?php
                                            $category_rs = Database::search("SELECT * FROM `category` ");
                                            $category_num = $category_rs->num_rows;

                                            for ($x = 0; $x < $category_num; $x++) {
                                                $category_data = $category_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $category_data["cat_id"] ?>">
                                                    <?php echo $category_data["cat_name"] ?>
                                                </option>
                                            <?php
                                            }
                                            ?>

                                            <!-- <option value="1">Laptops</option> -->
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <hr class="border border-3 border-danger">
                                    </div>

                                    <div class="col-12  mb-3">
                                        <select class="form-select" id="b1">
                                            <option value="0">Select Brand</option>
                                            <?php
                                            $brand_rs = Database::search("SELECT * FROM `brand` ");
                                            $brand_num = $brand_rs->num_rows;

                                            for ($x = 0; $x < $brand_num; $x++) {
                                                $brand_data = $brand_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $brand_data["brand_id"] ?>">
                                                    <?php echo $brand_data["brand_name"] ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                            <!-- <option value="1">Dell</option> -->
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <hr class="border border-3 border-danger">
                                    </div>

                                    <div class="col-12  mb-3">
                                        <select class="form-select" id="m">
                                            <option value="0">Select Model</option>
                                            <?php
                                            $model_rs = Database::search("SELECT * FROM `model` ");
                                            $model_num = $model_rs->num_rows;

                                            for ($x = 0; $x < $model_num; $x++) {
                                                $model_data = $model_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $model_data["model_id"] ?>">
                                                    <?php echo $model_data["model_name"] ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                            <!-- <option value="1">Latitude</option> -->
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <hr class="border border-3 border-danger">
                                    </div>

                                    <div class="col-12  mb-3">
                                        <select class="form-select" id="c2">
                                            <option value="0">Select Condition</option>

                                            <?php
                                            $condition_rs = Database::search("SELECT * FROM `condition` ");
                                            $condition_num = $condition_rs->num_rows;

                                            for ($x = 0; $x < $condition_num; $x++) {
                                                $condition_data = $condition_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $mcondition_data["condition_id"] ?>">
                                                    <?php echo $condition_data["condition_name"] ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                            <!-- <option value="1">Brandnew</option> -->
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <hr class="border border-3 border-danger">
                                    </div>

                                    <div class="col-12  mb-3">
                                        <select class="form-select" id="c3">
                                            <option value="0">Select Colour</option>
                                            <?php
                                            $color_rs = Database::search("SELECT * FROM `color` ");
                                            $color_num = $color_rs->num_rows;

                                            for ($x = 0; $x < $color_num; $x++) {
                                                $color_data = $color_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $color_data["clr_id"] ?>">
                                                    <?php echo $color_data["clr_name"] ?>
                                                </option>
                                            <?php
                                            }
                                            ?>
                                            <!-- <option value="1">Black</option> -->
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <hr class="border border-3 border-danger">
                                    </div>

                                    <div class="col-12  mb-3">
                                        <input type="text" class="form-control" placeholder="Price From..." id="pf" />
                                    </div>

                                    <div class="col-12  mb-3">
                                        <input type="text" class="form-control" placeholder="Price To..." id="pt" />
                                    </div>
                                    <div class="col-12">
                                        <hr class="border border-3 border-danger">
                                    </div>
                                    <div class="col-12  mt-2 mb-2">
                                        <select class="form-select border border-top-0 border-start-0 border-end-0 border-2 border-dark" id="s">
                                            <option value="0">SORT BY</option>
                                            <option value="1">PRICE LOW TO HIGH</option>
                                            <option value="2">PRICE HIGH TO LOW</option>
                                            <option value="3">QUANTITY LOW TO HIGH</option>
                                            <option value="4">QUANTITY HIGH TO LOW</option>
                                            <option value="5">NEWEST TO OLDEST</option>
                                            <option value="6">OLDEST TO NEWEST</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <hr class="border border-3 border-danger">
                                    </div>
                                    <div class="col-12 mb-3">
                                        <button class="btn btn-danger fw-bold" onclick="clearSort();">Clear</button>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>



            <div class=" right  bg-body rounded mb-3">
                <div class="row">
                    <div class="offset-lg-1 col-12 col-lg-10 text-center">
                        <div class="row align-items-center justify-content-center d-flex" id="view_area">
                           
                            <h1 class="opacity-50">Your products will appear here!</h1>

                            <!--back end-->



                            <!---->



                        </div>
                    </div>
                </div>
            </div>



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