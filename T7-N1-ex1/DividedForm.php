<?php
session_start();

error_reporting(E_ALL);
ini_set("display_errors", 0);

//sends errors to error_log.txt - needs retunnig
function myFormErrors($errno, $errstr, $errfile, $errline)
{
    $message = "Error: [$errno] $errstr - $errfile:$errline";
    error_log($message . PHP_EOL, 3, "error_log.txt");
}
set_error_handler("myFormErrors");


$err_emptyBox = "";
$err_invalid_Input = "";
$err_divideByZero = "";

$numberA = $_POST['numberA'] ?? '';
$numberB = $_POST['numberA'] ?? '';

if (isset($_POST['result'])) {
    $numberA = $_POST['numberA'];
    $numberB = $_POST['numberB'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST['numberA'])) {
            $err_emptyBox = "* number required";
        } else {
            if (!preg_match("/^[0-9]*$/", $numberA)) {
                $err_invalid_Input = "<br>* not an integer";
            }
        }
        if (empty($_POST['numberB'])) {
            $err_emptyBox = "<br>* number required";
        } else {
            if (!preg_match("/^[0-9]*$/", $numberB)) {
                $err_invalid_Input = "<br>* not an integer";
            }
        }

        //testing line: 
        //echo "<br>You've entered $numberA and $numberB<br>";
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">

    <title>Form</title>
</head>

<body>
    <div id=box>
        <h1>DIVIDING NUMBERS: </h1>

        <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">

            <label for="$numberA">Choose a number:</label><br>
            <input class="text" type="text" name="numberA" value="<?php echo htmlspecialchars($numberA); ?>"><br>
            <span class="error"> <?php echo $err_emptyBox, $err_invalid_Input; ?></span><br><br>

            <label for="$numberB">Choose a number to divide by:</label><br>
            <input class="text" type="text" name="numberB" value="<?php echo htmlspecialchars($numberB); ?>"><br>
            <span class="error"> <?php echo $err_emptyBox, $err_invalid_Input, $err_divideByZero; ?></span><br><br>
            <input class="button" type="submit" name="result" value="SEE RESULT">


        </form>

        <?php

        function divide(int $A, int $B): float
        {
            $result = 0;

            if ($B == 0) {
                throw new DivisionByZeroError(" You cannot divide by zero");
            } else {
                $result = $A / $B;
            }
            return $result;
        }

        if ($err_emptyBox === "" && $err_invalid_Input === "" && isset($_POST['result']) && $_SERVER["REQUEST_METHOD"] == "POST") {
            try {
                $divisionResult = divide($numberA, $numberB);
                $divisionResult = number_format($divisionResult, 2);
                echo "<br> RESULT: $divisionResult";
            } catch (DivisionByZeroError $e) {
                echo "Error: " . $e->getMessage();
            }
        }


        ?>
    </div>
</body>

</html>

<?php

session_destroy();
?>