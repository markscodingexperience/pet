<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
</head>
<body>
    <form action="result" method="post">
        <label for="name">Your Name: </label><input type="text" name="name"/><br>
        <label for="track">Course Title:</label>
        <select name="track">
            <option value="PHP Track">PHP Track</option>
            <option value="JS Track">JS Track</option>
            <option value="QA Track">QA Track</option>
        </select><br>
        <label for="score">Given Score (1-10):</label>
        <select name="score">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
        </select><br>
        <label for="reason">Reason:</label><textarea name="reason" cols="30" rows="10"></textarea><br>
        <input type="submit" value="Submit" name="submit"/>
    </form>
</body>
</html>