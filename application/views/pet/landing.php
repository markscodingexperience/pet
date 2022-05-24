<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url()?>/styles/styles.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>Welcome to e-PetCare</title>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a href="pets" class="navbar-brand"><img src="images/logo.png" alt="logo"></a>
                <div class="d-flex">
                    <a class="btn btn-outline-dark" href="/pets/signup">Sign up</a>
                    <a class="btn btn-outline-dark mx-3" href="/pets/login">Login</a>
                </div>
            </div>
        </nav>
    </div>
    <div class="container-fluid" id='section'>
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-7 col-sm-12">
                    <h1 class="py-5">The Better Way to manage your pet's health</h1>
                    <p>Get more value as a pet owner as you make sure your pet(s) get top notch quality services through various pet clinics offered.</p>
                    <a href="/pets/clinic" class="btn btn-primary">Browse Clinics</a>
                    <a href="<?= base_url() ?>petshits/frontdesk_login" class="btn btn-info">Do you have a Clinic?</a>
                </div>
                <div class="col-lg-7 col-md-5 col-sm-12">
                    <img src="images/cat.png" alt="" class="img-fluid pt-5 mx-auto d-block" width="300">
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid py-4" id="submenu">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="d-inline">
                        <span class="d-inline-block"><i class="fas fa-angle-double-down fa-lg d-inline-block"></i></span>
                    </div>
                    <div class="d-inline">
                        <h6 class="d-inline mb-0">Up to 2,000 clinics and pet stores</h6>
                        <p class="mb-0">Browse to your heart's limits</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="d-inline">
                        <span class="d-inline-block"><i class="fas fa-angle-double-down fa-lg d-inline-block"></i></span>
                    </div>
                    <div class="d-inline">
                        <h6 class="d-inline mb-0">Choose the right clinic for the right service!</h6>
                        <p class="mb-0">Check everything!</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <div class="d-inline">
                        <span class="d-inline-block"><i class="fas fa-angle-double-down fa-lg d-inline-block"></i></span>
                    </div>
                    <div class="d-inline">
                        <h6 class="d-inline mb-0">Save your pet medical history all in one place</h6>
                        <p class="mb-0">Ensuring the health of your pet</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="my-5">
        <div class="container">
            <div class="row">

                <div class="col-lg-3">
                    <p class="px-3">Contact</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><small>Street: 2017 Harron Drive</small></li>
                        <li class="list-group-item"><small>City: Baltimore</small></li>
                        <li class="list-group-item"><small>State: Minnesota</small></li>
                        <li class="list-group-item"><small>Zip Code: 69420</small></li>
                        <li class="list-group-item"><small>Phone Number: 443-498-3172</small></li>
                        <li class="list-group-item"><small>Mobile Number: 443-457-0120</small></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <p class="px-3">Menu</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><small><a href="#">Features</a></small></li>
                        <li class="list-group-item"><small><a href="#">About</a></small></li>
                        <li class="list-group-item"><small><a href="#">Rewards</a></small></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <p class="px-3">Legal</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><small><a href="#">Terms</a></small></li>
                        <li class="list-group-item"><small><a href="#">Privacy</a></small></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <p class="px-3">Search</p>
                    <input type="search" name="search" id="search">
                </div>
            </div>
            <div class="row">
                <p>All rights reserved</p>
            </div>
        </div>
    </footer>
</body>
</html>