<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <style>
        #bitch{
            text-align: center;
            display:flex;
            justify-content: center;
        }
        #cum{
            display: flex;
    align-items: center;
    flex-wrap: wrap;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">    
                <h4 class="mt-5"><?php extract($_SESSION['user']); $this->session->flashdata('code'); $this->session->flashdata('confirm_wrong');?>
                There is a 4-digit confirmation code sent to your email. Please confirm your email to go further.</h4>
                <form action="<?= base_url() ?>petshits/confirm" method="post">
                    <input type="email" value="<?= $email ?>" class="form-control mt-5" style="width: 300px;" disabled>
                    <input type="hidden" name="email" value="<?= $email ?>">
                    <div class="form-floating">
                        <input type="text" name="code" class="form-control mt-1" style="width: 250px;" id="code" required>
                        <label for="code" class="form-label">4 Digit Code</label>
                    </div>
                    <input type="submit" class="btn btn-outline-success mt-2" value="Submit Code">
                </form>
            </div>
            <div class="col-md-6" id="bitch">
                <img src="<?= base_url()?>/images/logo_registration.png" alt="" class="img-fluid" id="cum">
            </div>
        </div>
    </div> 
</body>
</html>