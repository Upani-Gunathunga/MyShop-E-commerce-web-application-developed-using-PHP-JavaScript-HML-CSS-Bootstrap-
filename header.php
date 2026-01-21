<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="bootstrap.css" />
  <link rel="stylesheet" href="style.css" />

</head>

<body>

  <div class="col-12">
    <div class="row mt-1 mb-1">
      <!-- mt=margin top mb=margin bottom -->

      <div class="offset-lg-1 col-12 col-lg-3 align-self-start mt-2">
        <?php




        ?>

        <nav class="navbar bg-body-tertiary fixed-top navbar-expand-lg">
          <div class="container-fluid">

            <a class="navbar-brand" href="#">
              <img src="resources/newtech logo.png" alt="Logo" height="34" class="d-inline-block align-text-top">
              Best Quality Electronic items
            </a>
            &nbsp; &nbsp;



            <!-- <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-danger" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                </svg>
              </button>
            </form> -->

            <!-- <a href="http://localhost/a1advancesearch/">Advanced Search</a> -->
            <ul class="nav">

              <li class="nav-item">

                <?php

                if (isset($_SESSION["u"])) {

                  $session_data = $_SESSION["u"];
                ?>

                  <div class="btn-group" role="group" aria-label="Default button group">
                    <button type="button" class="btn btn-outline-danger" onclick="signout();">Log Out</button>
                   

                  </div>

                <?php
                } else {
                ?>
                  <div class="btn-group" role="group" aria-label="Default button group">
                    <button type="button" class="btn btn-outline-danger"><a href="index.php" class="btn btn-danger">Log In<br></a></button>
                    <button type="button" class="btn btn-outline-danger"><a href="index.php" class="btn btn-danger">Register</a></button>

                  </div>

                <?php
                }


                ?>


              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="
              home.php
              ">Home Page</a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="http://localhost/a1adminhome/">ADMIN</a>
              </li> -->
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="watchlist.php">Watchlist</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="cart.php">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                  </svg>Cart
                </a>
              </li>
              <li class="nav-item">


                <?php

                if (isset($_SESSION["u"])) {

                  $session_data = $_SESSION["u"];
                ?>
              <!-- <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="sellerproducts.php">My Products</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="purchasingHistory.php">Purchasing History</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="messages.php">Message Admin</a>
              </li> -->
              

              
              <!---->
              <li class="nav-item">
              <div class="btn-group ">
                <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  View More
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item " href="sellerproducts.php">My Products</a></li>
                  <li><a class="dropdown-item " href="purchasingHistory.php">Purchasing History</a></li>
                  <li><a class="dropdown-item " href="messages.php">Message Admin</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item " href="adminSignIn.php">Admin Log In</a></li>
                </ul>
              </div>
              </li>
              <!---->

              <a class="nav-link" href="userProfile.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                </svg>
                <span class="text-lg-start text-decoration-none"><b>Hi, </b>
                  <?php echo $session_data["fname"] . " " . $session_data["lname"]; ?>
                </span>
              </a>

              




            <?php
                } else {
                }


            ?>




            </li>
            </ul>


          </div>

        </nav>



      </div>
    </div>

  </div>
  <script src="bootstrap.bundle.js"></script>


  <script src="script.js"></script>
</body>



</html>