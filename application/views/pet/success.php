<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mx-auto pt-5">
            <div class="col-5">
                <img src="<?= base_url() ?>images/success_logo.png" alt="Success Logo" class="img-fluid mx-auto d-block mt-5" style="width: 130px;">
                <center> <h2 class="mx-auto d-block">Your Payment is Successful!</h2> </center>
                <center> <h4 class="mx-auto d-block">Thank you for your payment!</h4> </center>
                <center> <a href="<?= base_url() ?>pets/show_orders" class="btn btn-success rounded my-5">Go back to Orders</a> </center>
            </div>
        </div>
    </div>
</body>
</html>