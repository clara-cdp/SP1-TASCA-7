<?php
session_start();

error_reporting(E_ALL);
ini_set("display_errors", 0);

//sends errors to error_log.txt 
function myFormErrors($errno, $errstr, $errfile, $errline)
{
    $message = "Error: [$errno] $errstr - $errfile:$errline";
    error_log($message . PHP_EOL, 3, "error_log.txt");
}
set_error_handler("myFormErrors");

enum MessageError: string
{
    case Required = "* number required";
    case Integer = "* not and integer";
    case zero = "* You cannot divide by zero";

    public function textMessage(): string
    {
        return $this->value;
    }
}
$errors = ['A' => null, 'B' => null];

$numberA = $_POST['numberA'] ?? '';
$numberB = $_POST['numberA'] ?? '';

if (isset($_POST['result'])) {
    $numberA = $_POST['numberA'];
    $numberB = $_POST['numberB'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if (empty($_POST['numberA'])) {
            $errors['A'] = MessageError::Required;
        } else {
            if (!preg_match("/^[0-9]*$/", $numberA)) {
                $errors['A'] = MessageError::Integer;
            }
        }
        if (empty($_POST['numberB']) && $_POST['numberB'] !== "0") {
            $errors['B'] = MessageError::Integer;
        } else {
            if (!preg_match("/^[0-9]*$/", $numberB)) {
                $errors['B'] = MessageError::Integer;
            } /*elseif ($numberB == 0){
                $errors['B'] = MessageError::Zero;*/
        }
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
            <span class="error"> <?php echo $errors['A']?->value ?? ""; ?></span><br><br>

            <label for="$numberB">Choose a number to divide by:</label><br>
            <input class="text" type="text" name="numberB" value="<?php echo htmlspecialchars($numberB); ?>"><br>
            <span class="error"> <?php echo $errors['B']?->value ?? ""; ?></span><br><br>
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

        if (
            isset($_POST['result']) && $_SERVER["REQUEST_METHOD"] == "POST"
        ) {
            try {
                $divisionResult = divide($numberA, $numberB);
                $divisionResult = number_format($divisionResult, 2);
                echo "<br> RESULT: $divisionResult";
            } catch (DivisionByZeroError $e) {
                echo "<br>Error: " . $e->getMessage();
            }
        }



        ?>
    </div>
</body>

</html>

<?php

session_destroy();
?>