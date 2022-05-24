<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destroy</title>
    <style>
        body{
            font-family: Poppins;
        }
    </style>
</head>
<body>
    <h1>Are you sure you want to delete?</h1>
    <?=
        $bookmark['folder'];
    ?>
    / <?= $bookmark['name'].' '.$bookmark['url'];  ?>

    <a href="http://localhost/bookmarks/show">No</a>
    <form action="delete/<?= $bookmark['id']; ?>" method="post">
        <input type="submit" value="Yes, I want to delete"/>
    </form>
</body>
</html>