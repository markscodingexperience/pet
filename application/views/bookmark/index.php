<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a book</title>
    <style>
        body{
            font-family: Poppins;
        }
    </style>
</head>
<body>
    <?php 
        // if (isset($_SESSION['message'])) {
        //     echo $message; 
        // }
    ?>
    <h1>Add a Bookmark</h1>
    <form action="validate" method="post">
        <label for="name">Name: </label>
        <input type="text" name="name"><br>
        <label for="URL">URL: </label>
        <input type="text" name="URL"><br>
        <label for="folder">Folder: </label>
        <select name="folder">
            <option value="Favorites">Favorites</option>
            <option value="Others">Others</option>
        </select>
        <input type="submit" value="Add">
    </form>

    <table>
        <tr>
        <td>Folder</td>
        <td>Name</td>
        <td>URL</td>
        <td>Action</td>
        <tr>
    <?php 
        foreach ($bookmarks as $key => $value) { ?>
           <tr>
               <td><?= $value['folder']; ?></td>
               <td><?= $value['name']; ?></td>
               <td><?= $value['url']; ?></td>
               <td><a href="destroy/<?= $value['id'] ?>">Delete</a></td>
           </tr> <?php
        } ?>
        </tr>
    </table>
</body>
</html>