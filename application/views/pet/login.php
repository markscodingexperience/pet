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
    <style>
        .image{
            text-align: center;
            display:flex;
            justify-content: center;
        }
        .img-fluid{
            width: 9%;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <div class="container-fluid">
            <div class="image my-5">
                <a href="<?= base_url();?>"><img src="<?= base_url();?>/images/logo.png" alt="Go back" class="img-fluid"></a>
            </div>
            <div class="row justify-content-center">
                <?php echo validation_errors(); ?>
                <center><?php echo $this->session->flashdata('password'); $this->session->flashdata('confirm_wrong');?> </center>
                <div class="mb-3 col-lg-5 px-5 py-5 mt-1 border rounded">
                    <!-- Form starts here -->
                    <form action="login_users" method="post">
                        <label for="email" class="form-label float-start">Email Address</label>
                        <input type="email" class="form-control" name="email" value="<?= $this->session->flashdata('email') ?>">
                        <label for="password" class="form-label float-start mt-2">Password</label>
                        <input type="password" class="form-control" name="password">
                        <input type="submit" class="btn btn-outline-success col-6 mx-auto mt-5 rounded-pill" value="Login">
                    </form>
                </div>
                <div>
                    <span><small>Don't have an account? <a href="/pets/signup" class="link-success">Sign Up</a></small></span>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>