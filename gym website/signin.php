<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vfit";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $fullname = $_POST["fullname"];
    $phone = $_POST["phone"];
    $membership = $_POST["membership"];

    $sql = "INSERT INTO users (username, password, fullname, phone, membership) VALUES ('$username', '$password', '$fullname', '$phone', '$membership')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: ". $sql. "<br>". $conn->error;
    }
}

$conn->close();
?>