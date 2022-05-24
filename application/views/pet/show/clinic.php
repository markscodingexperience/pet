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
                <a href="" class="navbar-brand"><img src="<?= base_url(); ?>/images/logo.png" alt="logo"></a>
                <div class="d-flex">
                    <a class="btn btn-outline-dark" href="/pets/signup">Sign up</a>
                </div>
            </div>
        </nav>
    </div>
    <div class="container py-5">
      <h1>Clinics you might want to check</h1>

    <table class="table">
<?php
        foreach ($data as $key => $value) { ?>
            <tr>
            <div class="card mb-3 border-start border-top-0 border-end-0 border-bottom-0 border-4 border-success rounded">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="<?= base_url() ?>images/<?= $value['image'] ?>" class="img-fluid rounded-start" style="height: 140px;" alt="...">
                    </div>
                
                <div class="col-md-8">
                <a href="get_clinic/<?= $value['id']; ?>" class="btn">
                    <div class="card-body">
                        <h5 class="card-title"><?= $value['clinic_name'] ?></h5>
                        <p class="card-text mb-0"><?= $value['unit_number']. ' '. $value['street']. ' ' . $value['municipality'] . ' ' .$value['city'] ?></p>
                        <p class="card-text text-muted"><?= $value['telephone']. '/'. $value['contact_number'] ?></p>
                    </div>
                </div>
                </a>
            </div>
        <!-- </div> -->
<?php    }
?>
    </tr>
    </table>
    </div>
    
</body>
</html>