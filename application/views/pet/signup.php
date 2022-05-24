<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url()?>/styles/stylesheet_for_signup.css">
    <!-- <link rel="stylesheet" href="<?= base_url()?>/styles/styles.css"> -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>Welcome to e-PetCare</title>
    <style>
        body{
            font-family: 'helvetica' !important;
        }
        #reg{
            background-color: rgb(75,136,34);
        }
        .img-fluid{
            width: 50%;
            margin: auto;
            display: block
        }
        #bitch{
            text-align: center;
            display:flex;
            justify-content: center;
        }
        input{
            border-radius: 10px 10px !important;
        }
        #logo{
            width: 80px;
        }
    </style>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a href="<?= base_url();?>" class="navbar-brand"><img src="<?= base_url();?>/images/logo.png" alt="logo" class="image-fluid" id="logo"></a>
                <div class="d-flex">
                    <a class="btn btn-outline-dark me-3" href="/pets/login">Login</a>
                </div>
            </div>
        </nav>
    </div>
   
    <div class="container py-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5" id="bitch">
                    <img src="<?= base_url()?>/images/logo_registration.png" alt="" class="img-fluid">
                </div>
                
                <div class="col-lg-7 px-5" id="reg">
                    <h1 class="text-light py-5">REGISTRATION FOR USERS</h1>
                    <div class="mb-3">
                        <form action="validate" method="post">
                            <div class="col-3">
                                <select class="form-select mb-3" name="type">
                                    <option value="1">PET OWNER</option>
                                    <option value="2">CLINIC OWNER</option>
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-6 pb-2">
                                    <label for="first_name" class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="first_name">
                                </div>
                                <div class="col-6">
                                    <label for="last_name" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="last_name">
                                </div>
                            </div>
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email">
                            <label for="password" class="form-label mt-2">Password</label>
                            <input type="password" class="form-control" name="password">
                            <label for="confirm" class="form-label mt-2">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm">
                            <?php echo validation_errors(); ?>
                            <div class="row justify-content-center">
                                <div class="col-lg-3">
                                    <input type="submit" class="btn btn-light my-5 px-5 rounded-pill" value="Register">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>