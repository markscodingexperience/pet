<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Medical History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>

        #id{
            background-size:cover;
        }

    </style>
    <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <style>
        .mh-100{
            height: 100vh;
        }
    </style>
</head>
<body>
    <?php 
        // $user = $this->session->userdata('user');
        $_SESSION['user'] = $this->session->userdata('user');
        extract($_SESSION['user']);
        $_SESSION['picture'] = $this->session->userdata('picture');
        extract($_SESSION['picture']);
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <div class="mh-100">
                    <div class="d-flex flex-column flex-shrink-0 p-3 bg-light h-100" style="width: 280px;">
                        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                        <img src="<?= base_url() ?>/images/logo.png" alt="" class="img-fluid">
                        </a>
                        <hr>
                        <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="<?= base_url()?>pets/login" class="nav-link link-dark" aria-current="page">
                                <i class="fa-solid fa-house pe-2"></i>Home
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url()?>pets/pet_history" class="nav-link active">
                                <i class="fa-solid fa-paw pe-2"></i>Pet History
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url() ?>pets/show_orders" class="nav-link link-dark">
                                <i class="fa-solid fa-cart-shopping pe-2"></i>Orders
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="items" class="nav-link link-dark" aria-current="page">
                                <i class="fa-solid fa-house pe-2"></i>Items
                            </a>
                        </li>
                        <li>
                        <li>
                            <a href="your_clinic" class="nav-link link-dark">
                                <i class="fa-solid fa-house-chimney-medical pe-2"></i>Your Clinics
                            </a>
                        </li>
                        <li>
                            <a href="pet" class="nav-link link-dark">
                                <i class="fa-solid fa-otter pe-2"></i>Pets
                            </a>
                        </li>
                        </ul>
                        <hr>
                        <div class="dropdown">
                            <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php if($profile == NULL){ ?>
                                    <img src="<?php base_url()?>/images/logo_registration.png" alt="" width="32" height="32" class="rounded-circle me-2">
            <?php               } else { ?>
                                    <img src="<?php base_url()?>/images/<?= $email ?>/profile/<?= $profile->image_name?>" alt="" width="32" height="32" class="rounded-circle me-2">
            <?php               } ?>
                                <strong><?= $first_name; ?></strong>
                            </a>
                            <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                                <li><a class="dropdown-item" href="profile">Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="logout">Sign out</a></li>
                            </ul>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="col-lg-9 py-5">
                <h1>Your Pet History</h1>
                <div class="row row-cols-6 row-cols-md-3 g-4 mt-3">
                    <table class="table" style="width: 100vh">
                        <thead>
                            <tr>
                                <td>Pet</td>
                                <td>Date</td>
                                <td>Title</td>
                                <td>Comments</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php 
                                    foreach ($history as $key => $value) { ?>
                                        <td><?= $value['name'] ?></td>
                                        <td><?= date_format(date_create($value['created_at']), "M d, Y") ?></td>
                                        <td><?php if ($value['title'] == '') { ?>
                                            No Data Available Yet
                                        <?php } ?><?= $value['title']?></td>
                                        <td><?php if ($value['title'] == '') { ?>
                                            No Data Available Yet
                                        <?php } ?><?= $value['comments']?></td>
                                    </tr>
                                <?php    }
                                ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>