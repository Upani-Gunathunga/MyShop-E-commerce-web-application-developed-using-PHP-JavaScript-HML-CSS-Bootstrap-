<!DOCTYPE html>
<html>

<head>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="bootstrap.css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="icon" href="resources/newtech logo.png" />
    <title>New Tech</title>
</head>

<body>
    <div class="container-fluid bg-danger bg-opacity-10">
        <div class="row">

            <?php
            session_start();
            require "connection.php";
            require "header.php";
            ?>
            <div style="height: 200px;">

            </div>

            <?php

            if (isset($_SESSION["u"])) {

                $email = $_SESSION["u"]["email"];

                $details_rs = Database::search("SELECT * FROM `users` INNER JOIN 
                `gender` ON users.gender_id=gender.id WHERE `email`='" . $email . "' ");

                $image_rs = Database::search(" SELECT * FROM `profile_img` WHERE `users_email`='" . $email . "' ");

                $address_rs = Database::search("SELECT * FROM `users_has_address` INNER JOIN 
                `city` ON users_has_address.city_city_id=city.city_id INNER JOIN `district` ON 
                district.district_id=city.district_district_id INNER JOIN `province` ON 
                province.province_id=province_province_id WHERE `users_email`= '" . $email . "' ");

                $details_data = $details_rs->fetch_assoc();
                $image_data = $image_rs->fetch_assoc();
                $address_data = $address_rs->fetch_assoc();
            ?>

                <!--n-->

                <div class="container bootstrap snippets bootdeys">
                    <div class="row">
                        <div class="col-12 col-lg-8 offset-lg-2">
                            <form class="form-horizontal">
                                <div class="col-12 justify-content-center">
                                    <hr class="border border-3 border-danger">
                                </div>
                                <div class="panel panel-default">
                                    <h1 class="text-center text-text-danger-emphasis">Hello <?php echo ($_SESSION["u"]["fname"] . " " . $_SESSION["u"]["lname"]); ?> !&#9996;</h1>
                                    <span class="fw-bold text-black-50 justify-content-center"><?php echo $email; ?></span>
                                    <div class="panel-body text-center">
                                        <!-- <img src="https://bootdey.com/img/Content/avatar/avatar6.png" class="img-circle profile-avatar" alt="User avatar"> -->
                                        <?php

                                        if (empty($image_data["path"])) {
                                        ?>
                                            <img src="resources/profile_images/User_0772447447_64f54ef60e705.jpeg" class="rounded-circle mt-5" style="width: 300px;" />
                                        <?php

                                        } else {
                                        ?>
                                            <img src="<?Php echo $image_data["path"]; ?>" class="rounded-circle mt-5" style="width: 300px;" />
                                        <?php
                                        }

                                        ?>
                                    </div>
                                    <input type="file" class="d-none" id="profileImage" />
                                    <label for="profileImage" class="btn btn-danger mt-5 text-center">Update Profile Image</label>
                                </div>
                                <div class="col-12">
                                    <hr class="border border-3 border-danger">
                                </div>
                                <div class="panel panel-default ">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">User info</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">First name</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="fname" class="form-control" value="<?php echo $details_data["fname"]; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Last name</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="lname" class="form-control" value="<?php echo $details_data["lname"]; ?>" />
                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Gender</label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" readonly value="<?php echo $details_data["gender_name"]; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label ">Registered date</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" readonly value="<?php echo $details_data["joined_date"]; ?>" />
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-12">
                                    <hr class="border border-3 border-danger">
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">Contact info</h4>
                                    </div>
                                    <div class="panel-body">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Mobile number</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="mobile" class="form-control" value="<?php echo $details_data["mobile"]; ?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">E-mail address</label>
                                            <div class="col-sm-10">
                                                <input type="text" id="email" class="form-control" value="<?php echo $details_data["email"]; ?>" />
                                            </div>
                                        </div>
                                        <?php
                                         $province_rs = Database::search(" SELECT * FROM `province`");
                                         $district_rs = Database::search(" SELECT * FROM `district`");
                                         $city_rs = Database::search(" SELECT * FROM `city`");
 
                                         $province_num = $province_rs->num_rows;
                                         $district_num = $district_rs->num_rows;
                                         $city_num = $city_rs->num_rows;
                                        
                                        ?>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Province</label>
                                            <div class="col-sm-10">
                                                <select id="province" class="form-control" onchange="loadDistricts();">
                                                    <option value="0">Select Province </option>

                                                    <?php

                                                    for ($x = 0; $x < $province_num; $x++) {

                                                        $province_data = $province_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $province_data["province_id"]; ?>">

                                                            <?php
                                                            if (!empty($address_data["province_province_id"])) {
                                                                if ($province_data["province_id"] == $address_data["province_province_id"]) {
                                                            ?> selected<?php

                                                                    }
                                                                }
                                                                        ?>

                                                                    <?php echo $province_data["province_name"]; ?>
                                                        </option>
                                                    <?php
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">District</label>
                                            <div class="col-sm-10">
                                                <select id="district" class="form-control" onchange="loadCities();">
                                                    <option value="0">Select District </option>

                                                    <?php

                                                    for ($y = 0; $y < $province_num; $y++) {

                                                        $district_data = $district_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $district_data["district_id"]; ?>">

                                                            <?php
                                                            if (!empty($address_data["district_district_id"])) {
                                                                if ($district_data["district_id"] == $address_data["district_district_id"]) {
                                                            ?> selected<?php

                                                                    }
                                                                }
                                                                        ?>

                                                                    <?php echo $district_data["district_name"]; ?>
                                                        </option>
                                                    <?php
                                                    }

                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">City</label>
                                            <div class="col-sm-10">
                                                <select id="city" class="form-control">
                                                    <option value="0">Select City </option>


                                                    <?php

                                                    for ($z = 0; $z < $city_num; $z++) {

                                                        $city_data = $city_rs->fetch_assoc();
                                                    ?>
                                                        <option value="<?php echo $city_data["city_id"]; ?>">

                                                            <?php
                                                            if (!empty($address_data["city_city_id"])) {
                                                                if ($city_data["city_id"] == $address_data["city_city_id"]) {
                                                            ?> selected<?php

                                                                    }
                                                                }
                                                                        ?>

                                                                    <?php echo $city_data["city_name"]; ?>
                                                        </option>
                                                    <?php
                                                    }

                                                    ?>

                                                </select>
                                            </div>
                                        </div>

                                        

                                        <!--backend-->

                                        <?php
                                        if (empty($address_data["postal_code"])) {
                                        ?>
                                         <div class="form-group">
                                         <label class="col-sm-2 control-label">Postal Code </label>
                                            <div class="col-sm-10">
                                                <input id="pc" type="text" class="form-control" placeholder="Enter your postal code" />
                                            </div>
                                         </div>
                                            
                                            
                                        <?php

                                        } else {
                                        ?>
                                        <div class="form-group">
                                        <label class="col-sm-2 control-label">Postal Code </label>
                                            <div class="col-sm-10">
                                                <input id="pc" type="text" class="form-control" value="<?php echo $address_data["postal_code"]; ?>" />
                                            </div>
                                        </div>
                                            
                                           
                                        <?php
                                        }

                                        if (empty($address_data["line1"])) {
                                        ?>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Address line 1 </label>
                                                <div class="col-sm-10">
                                                    <input type="text" id="line1" class="form-control" placeholder="Enter address line 1" />
                                                </div>

                                            </div>


                                        <?php

                                        } else {
                                        ?>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Address line 1 </label>
                                                <div class="col-sm-10">
                                                    <input type="text" id="line1" class="form-control" value="<?php echo $address_data["line1"]; ?>" />
                                                </div>
                                            </div>

                                        <?php
                                        }


                                        if (empty($address_data["line2"])) {
                                        ?>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Address line 2</label>
                                                <div class="col-sm-10">
                                                    <input type="text" id="line2" class="form-control" placeholder="Enter address line 2" />
                                                </div>
                                            </div>


                                        <?php

                                        } else {
                                        ?>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Address line 1 </label>
                                                <div class="col-sm-10">
                                                    <input type="text" id="line2" class="form-control" value="<?php echo $address_data["line2"]; ?>" />
                                                </div>
                                            </div>

                                        <?php
                                        }

                                       




                                        ?>

                                        <!--backend-->

                                    </div>
                                </div>
                                <div class="col-12">
                                    <hr class="border border-3 border-danger">
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">Security</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group col-sm-10">
                                            <label class="col-sm-2 control-label">Current password</label>
                                            <div class="input-group col-sm-10">
                                                <input type="password" value="<?php echo $details_data["password"]; ?>" class="form-control" aria-describedby="basic-addon2" id="pw">
                                                <span class="input-group-text" id="basic-addon2" onclick="showPassword3();"><i class="bi bi-eye"></i></span>

                                            </div>
                                        </div>


                                        <div class="form-group">

                                            <div class="col-sm-10 col-sm-offset-2 mt-4">
                                                <button type="submit" class="btn btn-danger" onclick="updateProfile();">Submit</button>
                                                <button type="reset" class="btn btn-danger">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <hr class="border border-3 border-danger">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--n-->



            <?php

            } else {
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