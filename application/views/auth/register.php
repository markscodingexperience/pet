<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <style>
        body{
            font-family: Poppins;
        }
    </style>
</head>
<body>
    <div>
        <h1>Sign Up</h1>
        <?= validation_errors(); ?>
        <form action="validate" method="post">
            <label for="first_name">First name: </label>
            <input type="text" name="first_name"><br>
            <label for="last_name">Last name: </label>
            <input type="text" name="last_name"><br>
            <label for="contact">Contact number: </label>
            <input type="text" name="contact"><br>
            <label for="password">Password: </label>
            <input type="password" name="password"><br>
            <label for="confirm">Repeat password:</label>
            <input type="password" name="confirm"><br>
            <input type="submit" value="Submit">
        </form>
    </div>

    <div>
        <h1>Log In</h1>
        <form action="login" method="post">
            <label for="contact">Contact: </label>
            <input type="text" name="contact"><br>
            <label for="password">Password: </label>
            <input type="text" name="password"><br>
            <input type="submit" value="Submit">
        </form>
    </div>

</body>
</html>