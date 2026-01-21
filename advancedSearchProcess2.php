<?php
require "connection.php";
session_start();

$search_txt = $_POST["t"];
$category = $_POST["cat"];
$brand = $_POST["b"];
$model = $_POST["mo"];
$condition = $_POST["con"];
$color = $_POST["col"];
$from = $_POST["pf"];
$to = $_POST["pt"];
$sort = $_POST["s"];
$seller_email = $_SESSION["u"]["email"];

$query = "SELECT * FROM `product` WHERE `users_email`= '".$seller_email."' ";
$status = 0;

if ($sort == 0) {
    if (!empty($search_txt)) {
        $query .= " AND `title` LIKE '%" . $search_txt . "%' ";
        $status = 1;
    }

    if ($category != 0 && $status == 0) {
        $query .= " AND `category_cat_id` ='" . $category . "' ";
    } else if ($category != 0 && $status != 0) {
        $query .= " AND `category_cat_id` ='" . $category . "' ";
    }

    $pid = 0;
    if ($brand != 0 && $model == 0) {

        $modelHasBrand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `brand_brand_id`='" . $brand . "'");
        $modelHasBrand_num = $modelHasBrand_rs->num_rows;
        // $modelHasBrand_data = $modelHasBrand_rs->fetch_assoc();
        // $pid = $modelHasBrand_data["id"];

        for ($x = 0; $x < $modelHasBrand_num; $x++) {
            $modelHasBrand_data = $modelHasBrand_rs->fetch_assoc();
            $pid = $modelHasBrand_data["id"];
        }

        if ($status == 0) {
            $query .= " AND `model_has_brand_id`='" . $pid . "'";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `model_has_brand_id`='" . $pid . "' ";
        }
    }
    if ($brand == 0 && $model != 0) {
        $modelHasBrand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `model_model_id`='" . $model . "'");
        $modelHasBrand_num = $modelHasBrand_rs->num_rows;

        for ($x = 0; $x < $modelHasBrand_num; $x++) {
            $modelHasBrand_data = $modelHasBrand_rs->fetch_assoc();
            $pid = $modelHasBrand_data["id"];
        }
        if ($status == 0) {
            $query .= " AND `model_has_brand_id`='" . $pid . "' ";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `model_has_brand_id`='" . $pid . "' ";
        }
    }
    if ($brand != 0 && $model != 0) {
        $modelHasBrand_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `model_model_id`='" . $model . "'
         AND `brand_brand_id`='" . $brand . "' ");
        $modelHasBrand_num = $modelHasBrand_rs->num_rows;

        for ($x = 0; $x < $modelHasBrand_num; $x++) {
            $modelHasBrand_data = $modelHasBrand_rs->fetch_assoc();
            $pid = $modelHasBrand_data["id"];
        }
        if ($status == 0) {
            $query .= " AND `model_has_brand_id` ='" . $pid . "' ";
            $status = 1;
        } else if ($status != 0) {
            $query .= " AND `model_has_brand_id` ='" . $pid . "' ";
        }
    }
    if ($condition != 0 && $status == 0) {
        $query .= " AND `condition_condition_id`='" . $condition . "'";
        $status = 1;
    } else if ($condition != 0 && $status != 0) {
        $query .= " AND `condition_condition_id`='" . $condition . "'";
    }
    if ($color != 0 && $status == 0) {
        $query .= " AND `color_clr_id`='" . $color . "'";
        $status = 1;
    } else if ($color != 0 && $status != 0) {
        $query .= " AND `color_clr_id`='" . $color . "'";
    }

    if (!empty($from) && empty($to)) {
        if ($status == 0) {
            $query .= " AND `price` >= '" . $from . "'";
        } elseif ($status != 0) {
            $query .= " AND `price` >= '" . $from . "'";
        }
    } else if (empty($from) && !empty($to)) {
        if ($status == 0) {
            $query .= " AND `price` <= '" . $to . "'";
        } elseif ($status != 0) {
            $query .= " AND `price` <= '" . $to . "'";
        }
    } else if (!empty($from) && !empty($to)) {

        if ($status == 0) {
            $query .= " AND `price` BETWEEN '" . $from . "' AND '" . $to . "'";
        } elseif ($status != 0) {
            $query .= " AND `price` BETWEEN '" . $from . "' AND '" . $to . "'";
        }
    }
} else if ($sort == 1) {
    if (!empty($search_txt)) {
        $query .= " AND `title` LIKE '%" . $search_txt . "%' ORDER BY `price` ASC ";
        $status = 1;
    }
} else if ($sort == 2) {
    if (!empty($search_txt)) {
        $query .= " AND `title` LIKE '%" . $search_txt . "%' ORDER BY `price` DESC ";
        $status = 1;
    }
} else if ($sort == 3) {
    if (!empty($search_txt)) {
        $query .= " AND `title` LIKE '%" . $search_txt . "%' ORDER BY `qty` ASC ";
        $status = 1;
    }
} else if ($sort == 4) {
    if (!empty($search_txt)) {
        $query .= " AND `title` LIKE '%" . $search_txt . "%' ORDER BY `qty` DESC ";
        $status = 1;
    }
}else if ($sort == 5) {
    if (!empty($search_txt)) {
        $query .= " AND `title` LIKE '%" . $search_txt . "%' ORDER BY `datetime_added` DESC ";
        $status = 1;
    }
}else if ($sort == 6) {
    if (!empty($search_txt)) {
        $query .= " AND `title` LIKE '%" . $search_txt . "%' ORDER BY `datetime_added` ASC ";
        $status = 1;
    }
}        

?>


<div class="row">
    <div class="offset-lg-1 col-12 col-lg-10 text-center">
        <div class="row">

            <?php

            if ("0" != $_POST["page"]) {
                $pageno = $_POST["page"];
            } else {
                $pageno = 1;
            }

            $product_rs = Database::search($query);
            $product_num = $product_rs->num_rows;

            $results_per_page = 4;
            $number_of_pages = ceil($product_num / $results_per_page);
            // echo($number_of_pages);

            $page_results = ($pageno - 1) * $results_per_page;
            $selected_rs = Database::search($query . " LIMIT " . $results_per_page . " OFFSET " . $page_results . " ");

            $selected_num = $selected_rs->num_rows;

            for ($x = 0; $x < $selected_num; $x++) {
                $product_data = $selected_rs->fetch_assoc();
                $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $product_data["id"] . "' ");
                $product_img_data = $product_img_rs->fetch_assoc();

            ?>
                <!-- card -->
                <div class="card bg-danger-subtle p-4" style="width: 18rem;">

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


                        <li class="list-group-item">Qty: <?php echo $product_data["qty"]; ?> In stock</li>

                    </ul>
                  
                    <div class="card-body text-center p-3">
                        <a href="<?php echo "singleProductView.php?id=".($product_data["id"]); ?>" class="card-link">View Full details</a><br>
                        <a class="col-12 btn btn-outline-danger" href="<?php echo "singleProductView.php?id=" . ($product_data["id"]); ?>">Buy Now</a>
                        <button class="btn btn-success fw-bold" onclick="sendId(<?php echo $product_data['id'];  ?>);">Update</button>
                        <button class="btn btn-danger fw-bold" >Delete</button>
                    </div>
                    <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="<?php echo $product_data["id"];  ?>" onchange="changeStatus(<?php echo $product_data['id']; ?>);" 
                                <?php 
                                if ($product_data["status_status_id"] == 2) {
                                     ?> checked <?php 
                                     } ?>
                                      />
                                <label class="form-check-label fw-bold text-info" for="<?php echo $product_data["id"];  ?>">
                                    <!-- Make Your Product Deactive -->
                                    <?php if ($product_data["status_status_id"] == 2) {
                                    ?>
                                        Activate product
                                    <?php
                                    } else {
                                    ?>
                                        Deactivate product
                                    <?php
                                    }
                                    ?>
                                </label>
                            </div>
                </div>
                <!-- card -->

            <?php
            }

            ?>

        </div>
    </div>
    <div class="offset-2 offset-lg-3 col-8 col-lg-6 text-center mb-3">
        <nav aria-label="Page navigation example">
            <ul class="pagination pagination-lg justify-content-center">
                <li class="page-item">
                    <a class="page-link" <?php
                                            if ($pageno <= 1) {
                                                echo ("#");
                                            } else {
                                                // echo "?page=" . ($pageno - 1);
                                            ?> onclick="advancedSearch2(<?php echo ($pageno - 1)  ?>)" <?php
                                                                                                    }

                                                                                                        ?> aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <?php

                for ($y = 1; $y <= $number_of_pages; $y++) {
                    if ($y == $pageno) {
                ?>
                        <li class="page-item active">
                            <a class="page-link" onclick="advancedSearch2(<?php echo ($y); ?>);"><?php echo $y;  ?></a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item ">
                            <a class="page-link" onclick="advancedSearch2(<?php echo ($y); ?>);"><?php echo $y;  ?></a>
                        </li>
                <?php
                    }
                }

                ?>

                <!-- 
                                            <li class="page-item active">
                                                <a class="page-link" href="#">1</a>
                                            </li>

                                            <li class="page-item">
                                                <a class="page-link" href="#">2</a>
                                            </li> -->

                <li class="page-item">
                    <a class="page-link" <?php
                                            if ($pageno >= $number_of_pages) {
                                                echo ("#");
                                            } else {
                                            ?> onclick="advancedSearch2(<?php echo ($pageno + 1)  ?>)" <?php
                                                                                                    }

                                                                                                        ?> aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>