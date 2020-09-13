<?php

$servername = "localhost";
$dbusername = "user";
$dbpassword = "pass";
$dbname = "message_app";

$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

if (!$conn) {
    die("Connection failed: ".mysqli_connect_error());
}