<?php
session_start();
require "connection.php";
if (isset($_SESSION["u"])) {
    if (isset($_SESSION["p"])) {

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
                                    <div class="col-2">
                                        <div class="mt-2 mb-2 logo" style="height: 80px;"></div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <P class="fs-1 text-text-danger-emphasis fw-bold mt-3 pt-2 text-lg-start">Update an existing product</P>
                                    </div>
                                    <div class="col-12 d-none border-warning" id="msgdiv1">
                                        <div class="alert alert-danger text-center fw-bolder rounded-bottom-pill " role="alert" id="msg1" style="font-size: larger;">

                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr class="border border-3 border-danger">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class=" left1  mb-3  border-end bg-body rounded">
                        <div class="row">



                            <div class="col-12">
                                <div class="row">

                                    <div class="col-12">
                                        <div class="row">

                                            <div class="col-12  mb-3">
                                                <select class="form-select " disabled>
                                                    <?php

                                                    $product = $_SESSION["p"];
                                                    $category_rs = Database::search("SELECT * FROM `category` WHERE `cat_id`='" . $product["category_cat_id"] . "' ");
                                                    $category_data = $category_rs->fetch_assoc();

                                                    ?>
                                                    <option><?php echo $category_data["cat_name"];  ?></option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <hr class="border border-3 border-danger">
                                            </div>

                                            <div class="col-12  mb-3">
                                                <select class="form-select" disabled>
                                                    <?php
                                                    $brand_rs = Database::search("SELECT * FROM `brand` WHERE `brand_id` IN 
                                                            (SELECT `brand_brand_id` FROM `model_has_brand` WHERE 
                                                            `id` = '" . $product["model_has_brand_id"] . "')");

                                                    $brand_data = $brand_rs->fetch_assoc();

                                                    ?>
                                                    <option><?php echo $brand_data["brand_name"];  ?></option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <hr class="border border-3 border-danger">
                                            </div>

                                            <div class="col-12  mb-3">
                                                <select class="form-select" id="model" disabled>
                                                    <?php
                                                    $model_rs = Database::search("SELECT * FROM `model` WHERE `model_id` IN 
                                                            (SELECT `model_model_id` FROM `model_has_brand` WHERE 
                                                            `id` = '" . $product["model_has_brand_id"] . "')");

                                                    $model_data = $model_rs->fetch_assoc();

                                                    ?>
                                                    <option><?php echo $model_data["model_name"];  ?></option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <hr class="border border-3 border-danger">
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold">
                                                            Product Title
                                                        </label>
                                                    </div>
                                                    <div class="col-12">
                                                        <input type="text" class="form-control" value="<?php echo $product["title"]; ?>" id="t" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <hr class="border border-3 border-danger">
                                            </div>
                                            <div class="col-12 mb-3">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold">Select Product Condition</label>
                                                    </div>

                                                    <?php

                                                    if ($product["condition_condition_id"] == 1) {
                                                    ?>

                                                        <div class="col-12">
                                                            <div class="form-check form-check-inline mx-5">
                                                                <input class="form-check-input" type="radio" id="b" name="c" checked disabled />
                                                                <label class="form-check-label fw-bold" for="b">Brandnew</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" id="u" name="c" disabled />
                                                                <label class="form-check-label fw-bold" for="u">Used</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" id="g" name="c" disabled />
                                                                <label class="form-check-label fw-bold" for="g">Good</label>
                                                            </div>
                                                        </div>

                                                    <?php
                                                    } else if ($product["condition_condition_id"] == 2) {
                                                    ?>

                                                        <div class="col-12">
                                                            <div class="form-check form-check-inline mx-5">
                                                                <input class="form-check-input" type="radio" id="b" name="c" disabled />
                                                                <label class="form-check-label fw-bold" for="b">Brandnew</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" id="u" name="c" checked disabled />
                                                                <label class="form-check-label fw-bold" for="u">Used</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" id="g" name="c" disabled />
                                                                <label class="form-check-label fw-bold" for="g">Good</label>
                                                            </div>
                                                        </div>

                                                    <?php
                                                    } else if ($product["condition_condition_id"] == 3) {
                                                    ?>

                                                        <div class="col-12">
                                                            <div class="form-check form-check-inline mx-5">
                                                                <input class="form-check-input" type="radio" id="b" name="c" disabled />
                                                                <label class="form-check-label fw-bold" for="b">Brandnew</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" id="u" name="c" disabled />
                                                                <label class="form-check-label fw-bold" for="u">Used</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" id="g" name="c" checked disabled />
                                                                <label class="form-check-label fw-bold" for="g">Good</label>
                                                            </div>
                                                        </div>

                                                    <?php
                                                    }

                                                    ?>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <hr class="border border-3 border-danger">
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold">Product Description</label>
                                                    </div>
                                                    <div class="col-12">
                                                    <textarea cols="30" rows="15" class="form-control" id="d"><?php echo $product["description"]; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <hr class="border border-3 border-danger">
                                            </div>




                                            <div class="col-12  mb-3">
                                                <select class="form-select" disabled>
                                                    <?php

                                                    $color_rs = Database::search("SELECT * FROM `color` WHERE `clr_id` = '" . $product["color_clr_id"] . "'");
                                                    $color_data = $color_rs->fetch_assoc();


                                                    ?>

                                                    <option><?php echo $color_data["clr_name"]; ?></option>
                                                </select>
                                            </div>
                                            <div class="col-12">
                                            <div class="input-group mt-2 mb-2">
                                                            <input type="text" class="form-control" placeholder="Add new Colour" disabled />
                                                            <button class="btn btn-outline-primary" type="button" id="button-addon2" disabled>+ Add</button>
                                                        </div>
                                            </div>
                                            <div class="col-12">
                                                <hr class="border border-3 border-danger">
                                            </div>

                                            <div class="col-12 ">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold">Add Product Quantity</label>
                                                    </div>
                                                    <div class="col-12">
                                                        <input type="number" class="form-control" min="0" value="<?php echo $product["qty"]; ?>" id="q" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <hr class="border border-3 border-danger">
                                            </div>
                                            <div class="col-12">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label class="form-label fw-bold">Cost Per Item</label>
                                                    </div>
                                                    <div class=" col-12">
                                                    <div class="input-group mb-2 mt-2">
                                                            <span class="input-group-text">Rs.</span>
                                                            <input type="text" class="form-control" disabled value="<?php echo $product["price"]; ?>" />
                                                            <span class="input-group-text">.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <hr class="border border-3 border-danger">
                                            </div>
                                            <div class="col-12 ">
                                                <div class="row">
                                                    <div class="col-12 ">
                                                        <label class="form-label">Delivery cost Within Colombo</label>
                                                    </div>
                                                    <div class="col-12 ">
                                                        <div class="input-group mb-2 mt-2">
                                                            <span class="input-group-text">Rs.</span>
                                                            <input type="text" class="form-control" value="<?php echo $product["delivery_fee_colombo"]; ?>" id="dwc" />
                                                            <span class="input-group-text">.00</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 ">
                                                        <label class="form-label">Delivery cost out of Colombo</label>
                                                    </div>
                                                    <div class="col-12 ">
                                                        <div class="input-group mb-2 mt-2">
                                                            <span class="input-group-text">Rs.</span>
                                                            <input type="text" class="form-control" value="<?php echo $product["delivery_fee_other"]; ?>" id="doc" />
                                                            <span class="input-group-text">.00</span>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>



                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>



                    <div class=" right1  bg-body rounded mb-3 p-3">
                        <div class="row">
                            <div class="col-12">
                                <label class="form-label fw-bold">Add Product Images</label>
                            </div>
                            <div class="col-12">

                            <?php
                                            
                                            $img = array();
                                            $img [0]= "resources/addproduct_img.png";
                                            $img [1]= "resources/addproduct_img.png";
                                            $img [2]= "resources/addproduct_img.png";
                                            $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='".$product["id"]."' ");
                                            
                                            $img_num = $img_rs->num_rows;
                                            for ($x=0; $x < $img_num; $x++) { 
                                                $img_data = $img_rs->fetch_assoc();
                                                $img[$x] = $img_data["img_path"];
                                            }
                                            
                                            ?>
                               
                            
                                <div class="row">
                                <div class="col-4 border border-primary rounded">
                                                        <img src="<?php echo $img[0]; ?>" class="img-fluid" style="width: 250px;" />
                                                    </div>
                                                    <div class="col-4 border border-primary rounded">
                                                        <img src="<?php echo $img[1]; ?>" class="img-fluid" style="width: 250px;" />
                                                    </div>
                                                    <div class="col-4 border border-primary rounded">
                                                        <img src="<?php echo $img[2]; ?>" class="img-fluid" style="width: 250px;" />
                                                    </div>
                                </div>
                            </div>
                            <div class=" col-12 ">
                                <input type="file" class="d-none" id="imageuploader" multiple />
                                <label for="imageuploader" class="col-12 btn btn-danger mt-3" onclick="changeProductImage();">Upload Images</label>
                            </div>

                            <div class="col-12 mt-5">
                                <label class="form-label fw-bold">Notice...</label><br />
                                <label class="form-label">
                                    We are taking 3% of the product from price from every
                                    product as a service charge.
                                </label>
                            </div>
                            <div class="col-6 d-grid mt-6 mb-3">
                                <button class="btn btn-danger" onclick="updateProduct();">Update  Product</button>
                            </div>
                            <div class="col-6 mb-3 d-grid mt-6">
                                <button class="btn btn-outline-danger fw-bold" onclick="clearSort();">Clear</button>
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
    <?php
    } else {
    ?>
        <script>
            alert("Please select a product.");
            window.location = "myProducts.php";
        </script>
    <?php
    }
} else {
    ?>
    <script>
        alert("You have to login first.");
        window.location = "home.php";
    </script>
<?php
}


?>