<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MREP</title>
</head>
<body>
<h1><?=$name;?></h1>
<h2><?=$age;?></h2>
<h3><?=$location;?></h3>
<ul>
    <?php 
        foreach ($hobbies as $value) { ?>
            <li><?=$value;?></li>
<?php   }
    ?>

</ul>

</body>
</html>