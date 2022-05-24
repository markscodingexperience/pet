<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ninja</title>
</head>
<body>
<h1><?= $data ?> Beautiful Ninjas</h1>

    <?php 
        if($data > 5){
            for ($i=0; $i < $data; $i++) { ?>
                <img src="<?= base_url('images/ninja3.jpg');?>">
        <?php    }
        }else{ ?>
            <img src="<?= base_url($image1)?>">
            <img src="<?= base_url($image1)?>">
            <img src="<?= base_url($image1)?>">
<?php
        }
    ?>
         
    


</body>
</html>