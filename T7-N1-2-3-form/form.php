<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">

    <title>BatForm</title>
</head>

<body>
    <div class="questionare">
        <h1>Registration form</h1>

        <form action="action_page.php" method="post">

            <label for="userName">Name:</label><br>
            <input class="text-field" type="text" name="userName" placeholder="Bruce Wayne"><br><br>

            <label for="userEmail">Email:</label><br>
            <input class="text-field" type="text" name="userEmail"
                placeholder="batman@wayneenterprises.com"><br><br>

            <label for="userPhone">Phone number:</label><br>
            <input class="text-field" type="text" name="userPhone"
                placeholder="555 12 34 56"><br><br>

            <label for="URL">Your URL</label><br>
            <input class="text-field" type="text" name="userURL"
                placeholder="wayneenterprises.com"><br><br>


            <br>
            <br>

            <input class="button" type="submit" name="submit" value="register">
        </form>
    </div>
</body>

</html>