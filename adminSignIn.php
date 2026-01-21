<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="resources/newtech logo.png" />
    <title>New Tech</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css">

</head>

<body class="main-body overflow-x-hidden">
    <div class="container-fluid">
        <!--blank div start-->
        <div style="height: 200px;"></div>
        <!--blank div end-->

       <?php
       require "header.php";
       ?>
        <!--main content start-->

        <div class=" row justify-content-center d-flex ">
            <div class="col-12 align-content-center d-flex">

                <div class="row">

                    <div class="col-12 col-md-6 p-3 mt-5">
                        <div class="row align-items-center">
                            <img src="resources/newtech logo.png" style="background-position: center;"><br>
                            <h1 class="text-center">Best for quality electronic items<br>
                                Welcome New Tech Admin<br>
                            </h1>
                            <button class="btn btn-danger disabled" >Log in to your account using company email</button>
                        </div>

                    </div>

                    <div class="col-12 col-md-6 p-3 align-content-center d-flex" style="background-color: brown;" id="signinbox">
                        <div class="row g-2">
                            <div class="col-12">
                                <h2>Log in to your account<h2>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Company Email</label>
                                <input class="form-control col-12" type="email" placeholder="type your email" id="e">
                            </div>
                            <!-- <div class="col-12">
                                <label class="form-label">Password</label>
                                <input class="form-control" type="password" placeholder="ex: ******">
                                <div class="col-auto">
                                    <span id="passwordHelpInline" class="form-text">
                                        Must be 8-20 characters long.
                                    </span>
                                </div>
                            </div> -->
                            <!-- <div class="col-12">
                                <label class="form-label">Your Skills</label>
                                <div class="form-floating">

                                    <textarea class="form-control" placeholder="We would like to know your skills" id="floatingTextarea2" style="height: 100px"></textarea>
                                    <label for="floatingTextarea2">Comment about your skills</label>
                                </div>
                            </div> -->

                            <!-- <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="rememberme">
                                    <label class="form-check-label" for="rememberme">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                            <div class="col-6 text-end">
                                <a href="#" class="link-primary">Forgotten password</a>
                            </div> -->
                            <div class="col-12 col-lg-6  mt-2">
                                <button class="btn btn-outline-light" onclick="adminVerification();">Log In(ADMIN)</button>
                            </div>



                        </div>
                    </div>
                </div>



            </div>


        </div>
        <br>

        <!--main content end-->
         <!--  -->

         <div class="modal" tabindex="-1" id="verificationModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Admin Verification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Enter Your Verification Code</label>
                            <input type="text" class="form-control" id="vcode">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="verify();">Verify</button>
                        </div>
                    </div>
                </div>
            </div>

            <!--  -->
        <?php
        require "footer.php";
        ?>

    </div>

    <script src="script.js"></script>
    <script src="bootstrap.bundle.min.js"></script>
</body>

</html>