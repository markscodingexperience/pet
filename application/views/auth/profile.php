<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        body{
            font-family: Poppins;
        }
    </style>
</head>
<body>
    <form action="logout" method="post"><input type="submit" value="Bitch, Log out"> </form> 
    <?php 
        $user = $this->session->userdata('user');
        extract($user);
    ?>
    <h1>Basic Information</h1>
    <span>First Name: <?= $first_name; ?></span><br>
    <span>Last Name: <?= $last_name; ?></span><br>
    <span>Contact Number: <?= $contact; ?></span><br>
    <span>Last Failed Login: <?= $last_failed_login; ?></span>

</body>
</html>
