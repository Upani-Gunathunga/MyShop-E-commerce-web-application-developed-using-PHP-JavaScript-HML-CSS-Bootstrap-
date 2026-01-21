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
        <div class="container-fluid w-100  col-12 fixed-top">
            <ul class="nav nav-tabs bg-danger-subtle text-light-emphasis">
                <li></li>
                <img src="resources/newtech logo.png" style="height: 30px;">
                <h5 class="align-content-end text-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-person-square alert-danger" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                        <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2zm12 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1v-1c0-1-1-4-6-4s-6 3-6 4v1a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12z" />
                    </svg>
                    HI! UPANI(ADMIN)

                </h5>
                <li></li>
                <li class="nav-item  text-decoration-none">
                    <a class="nav-link " aria-current="page" href="http://localhost/a1adminhome/">HOME PAGE</a>
                </li>
                <li class="nav-item  text-decoration-none">
                    <a class="nav-link active" href="http://localhost/a1adminsignin/">ADMIN SIGN IN</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/a1adminpanel/">ADMIN PANEL</a>
                </li>
                <li class="nav-item dropdown  text-decoration-none">
                    <a class="nav-link dropdown-toggle text-decoration-none" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">MANAGE</a>
                    <ul class="dropdown-menu">

                        <li><a class="dropdown-item text-decoration-none" href="http://localhost/a1productmanage/">MANAGE PRODUCTS</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item text-decoration-none" href="http://localhost/a1usermanage/">MANAGE USERS</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="http://localhost/a1customerhome/">
                        <span class="badge bg-secondary">GO BACK TO WELCOME PAGE</span></a>
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