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
    <?php
    require 'action_page.php';
    $userName = $_POST['userName'] ?? '';
    $userEmail =  $_POST['userName'] ?? '';
    $userPhone = $_POST['userName'] ?? '';
    $userURL = $_POST['userURL'] ?? '';
    ?>
    <div class="questionare">
        <h1>Registration form</h1>

        <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">

            <label for="userName">Name:</label><br>
            <input class="text-field" type="text" name="userName"
                placeholder="Bruce Wayne"><br>
            <span class="error"> <?php echo $err_emptyName, $err_name; ?></span><br><br>

            <label for="userEmail">Email:</label><br>
            <input class="text-field" type="text" name="userEmail"
                placeholder="batman@wayneenterprises.com"><br>
            <span class="error"> <?php echo $err_emptyEmail, $err_email; ?></span><br><br>

            <label for="userPhone">Phone number:</label><br>
            <input class="text-field" type="text" name="userPhone"
                placeholder="555 12 34 56"><br>
            <span class="error"> <?php echo $err_emptyPhone, $err_phone; ?></span><br><br>

            <label for="URL">Your URL</label><br>
            <input class="text-field" type="text" name="userURL"
                placeholder="www.wayneenterprises.com"><br>
            <span class="error"> <?php echo $err_emptyURL, $err_URL; ?></span><br><br>


            <br><br>
            <input class="button" type="submit" name="submit" value="register">

        </form>
        <?php
        if (isset($_POST['submit'])) {

            if (
                $err_emptyName == "" && $err_name == ""
                && $err_emptyEmail && $err_email == ""
                && $err_emptyPhone && $err_phone == ""
                && $err_emptyURL && $err_URL == ""
            ) {
                echo "<br>Hello $userName !!<br>
                <br> Email: $userEmail
                <br> Phone Number: $userPhone
                <br> Web: $userURL
                <br> ";
            } else {
                echo "<br>wathever man!";
            }
        }

        ?>

    </div>
</body>

</html>


<?php
session_destroy();
