<?php
session_start();
?>

<html>
<link rel="stylesheet" href="styles.css">

<body>
    <div class=Questionare>

        <style>
            div {
                text-align: center;
            }
        </style>

        <?php

        $_SESSION['userName'] = !empty($_POST['userName']) ? htmlspecialchars($_POST['userName']) : '- GUEST -';
        $_SESSION['userEmail'] = !empty($_POST['userEmail']) ? htmlspecialchars($_POST['userEmail']) : '- No email provided -';


        echo "<h2>Hello " . $_SESSION['userName'] . "</h2><br>Once again...welcome to my house. Come freely. Go safely; and leave something of the happiness you bring.<br>";
        echo "<br>Our newsletter will be sent to " . $_SESSION['userEmail'] . "<br>";

       

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
       



        ?>
        <form action="form.php" method="post">
            <input class="button" type="submit" name="submit" value="RUN AWAY!">
        </form>

        <?php

        if (isset($_post["RUN AWAY!"])) {
            session_destroy();
            header("Location:form.php");
        }

        ?>
    </div>

</body>

</html>