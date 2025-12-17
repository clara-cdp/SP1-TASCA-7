<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);



$err_name = "";
$err_email = "";
$err_phone = "";
$err_URL = "";

$err_emptyName = "";
$err_emptyEmail = "";
$err_emptyPhone = "";
$err_emptyURL = "";

$userName = $_POST['userName'] ?? '';
$userEmail =  $_POST['userName'] ?? '';
$userPhone = $_POST['userName'] ?? '';
$userURL = $_POST['userURL'] ?? '';

if (isset($_POST['submit'])) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {


        if (empty($_POST['userName'])) {
            $err_emptyName = "* requiered field";
        } else {
            $userName = test_input($_POST["userName"]);
            if (!preg_match("/^[a-zA-Z0-9_]*$/", $userName)) {
                $err_name = "* Only alphabets, numbers, and underscores allowed";
            }
        }

        if (empty($_POST["userEmail"])) {
            $err_emptyEmail = "required field";
        } else {
            $userEmail = test_input($_POST["userEmail"]);
            if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
                $emailIDErr = "Invalid Email";
            }
        }

        if (empty($_POST["userPhone"])) {
            $err_emptyPhone = "required field";
        } else {
            $userPhone = test_input($_POST["userPhone"]);
            if (!preg_match("/^[0-9]*$/", $userPhone)) {
                $err_phone = "<br>Only numeric values are allowed";
            }
        }

        if (empty($_POST["userURL"])) {
            $err_emptyURL = "required field";
        } else {
            $userEmail = test_input($_POST["userURL"]);
            if (!preg_match(
                "/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",
                $userURL
            )) {
                $err_URL = "<br>You entered an INVALID URL";
            }
        }
    }
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
