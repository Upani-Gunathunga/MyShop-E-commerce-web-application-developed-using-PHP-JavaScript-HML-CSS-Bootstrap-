<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="resources/newtech logo.png" />
    <title>New Tech</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body class="main-body">
    <div class="container-fluid vh-100 justify-content-center d-flex">
        <div class="row align-content-center">
            <!--header-->
            <div class="col-12">
                <div class="row">
                    <div class="col-12 logo"></div>
                    <div class="col-12">
                        <p class="text-center title01"> Welcome to New Tech online store</p>
                    </div>
                </div>

            </div>
            <!--header-->
            <!--content-->
            <div class="col-12 p-3">
                <div class="row">
                    <div class="col-6 d-lg-block background"></div>
                    <!--signup box-->
                    <div class="col-12 " id="signupbox">
                        <div class="row g-2">
                            <!--main content start-->
                            <div class=" row justify-content-center d-flex ">
                                <div class="col-12 align-content-center d-flex">

                                    <div class="row">

                                        <div class="col-12 col-md-6 p-3 mt-5">
                                            <div class="row align-items-center">
                                                <img src="resources/newtech logo.png" style="background-position: center;"><br>
                                                <h1 class="text-center">Best for quality electronic items<br>
                                                    Already a member?
                                                    <br>
                                                </h1>

                                                <a class="btn btn-danger" onclick="changeView();">LOG IN</a>

                                            </div>

                                        </div>


                                        <div class=" col-12 col-md-6 d-grid" style="background-color: brown;">
                                            <div class="row g-3">
                                                <div class="col-12">
                                                    <h2>Register for free</h2>
                                                </div>
                                                <div class="col-12 d-none" id="msgdiv">
                                                    <div class="alert alert-danger" role="alert" id="msg">

                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label">First name</label>
                                                    <input class="form-control" type="text" placeholder="your name" id="fname">
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label">Last name</label>
                                                    <input class="form-control" type="text" placeholder="your name" id="lname">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label">Email</label>
                                                    <input class="form-control" type="email" placeholder="your email" id="email">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label">Password</label>
                                                    <input class="form-control" type="password" placeholder="ex: ******" id="password">
                                                    <div class="col-auto">
                                                        <span id="passwordHelpInline" class="form-text">
                                                            Must be 5-20 characters long.
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label">Mobile</label>
                                                    <input class="form-control" type="text" placeholder="your mobile" id="mobile">
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label">Gender</label>

                                                    <select class="form-control" id="gender">

                                                        <option value="0">Select your Gender</option>

                                                        <?php
                                                        require "connection.php";
                                                        $rs = Database::search("SELECT * FROM `gender`");
                                                        $n = $rs->num_rows;

                                                        for ($x = 0; $x < $n; $x++) {
                                                            $d = $rs->fetch_assoc();

                                                        ?>
                                                            <option value="<?php echo $d["id"]; ?>"><?php echo $d["gender_name"]; ?>

                                                            </option>
                                                        <?php

                                                        }
                                                        ?>

                                                    </select>

                                                </div>
                                                <div class="col-12 col-lg-6 mt-2 align-items-center">
                                                    <button class="btn btn-outline-light" onclick="signUp();">Register</button>
                                                </div>




                                            </div>

                                        </div>
                                    </div>



                                </div>


                            </div>
                            <br>
                            <!--main content end-->

                        </div>

                    </div>
                    <!--signup box-->

                    <!--signin box-->
                    <div class="col-12  d-none" id="signinbox">
                        <div class="row g-2">
                            <!--main content start-->
                            <div class=" row justify-content-center d-flex ">
                                <div class="col-12 align-content-center d-flex">

                                    <div class="row">

                                        <div class="col-12 col-md-6 p-3 mt-5">
                                            <div class="row align-items-center">
                                                <img src="resources/newtech logo.png" style="background-position: center;"><br>
                                                <h1 class="text-center">Best for quality electronic items<br>
                                                    New Here?<br>
                                                    Create a new account to continue<br></h1>

                                                <a class="btn btn-danger" onclick="changeView();">REGISTER</a>
                                            </div>

                                        </div>

                                        <div class="col-12 col-md-6 p-3 align-content-center d-flex" style="background-color: brown;" id="signinbox">
                                            <div class="row g-2">
                                                <div class="col-12">
                                                    <h2>Log in to your account<h2>
                                                </div>
                                                <?php
                                                $email = "";
                                                $password = "";

                                                if (isset($_COOKIE["email"])) {
                                                    $email = $_COOKIE["email"];
                                                }

                                                if (isset($_COOKIE["password"])) {
                                                    $password = $_COOKIE["password"];
                                                }




                                                ?>
                                                <div class="col-12">
                                                    <label class="form-label">Email</label>
                                                    <input class="form-control" type="email" placeholder="type your email" id="email2">
                                                </div>
                                                <div class="col-12">
                                                    <label class="form-label">Password</label>
                                                    <input class="form-control" type="password" placeholder="ex: ******" id="password2">
                                                    <div class="col-auto">
                                                        <span id="passwordHelpInline" class="form-text">
                                                            Must be 5-20 characters long.
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" id="rememberme">
                                                        <label class="form-check-label" for="rememberme">
                                                            Remember Me
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 text-end">
                                                    <a href="#" class="link-primary" onclick="forgotPassword();">Forgotten password</a>
                                                </div>
                                                <div class="col-12 col-lg-6  mt-2">
                                                    <button class="btn btn-outline-light" onclick="signin();">Log In</button>
                                                </div>


                                            </div>
                                        </div>
                                    </div>



                                </div>


                            </div>
                            <br>
                            <!--main content end-->
                        </div>
                    </div>
                    <!--signin box-->

                </div>

            </div>
            <!--content-->
            <!--modal-->
            <div class="modal" tabindex="-1" id="forgotPasswordModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Forgot Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label"> New Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="np">
                                        <button class="btn btn-outline-secondary" type="button" id="npb" onclick="showPassword();"><i class="bi bi-eye"></i></button>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <label class="form-label"> Retype New Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="rnp">
                                        <button class="btn btn-outline-secondary" type="button" id="rnpb" onclick="showPassword2();"><i class="bi bi-eye"></i></button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">Verification Code</label>
                                    <input type="text" class="form-control" id="vc">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="resetPassword();">Reset Password</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--modal-->



            <!--footer-->
            <div class="col-12 d-none d-lg-block fixed-bottom">
                <p class="text-center">&copy; 2023 newtech.lk.lk || All Rights Reserved
                </p>
            </div>
            <!--footer-->
        </div>

    </div>
    <script src="bootstrap.js"></script>
    <script src="script.js"></script>

</body>

</html>