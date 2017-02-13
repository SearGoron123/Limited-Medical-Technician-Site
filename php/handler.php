<?php
$servername = "192.168.0.12";
$username = "admin";
$password = "itsasecret";
$dbname = "cct-data";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$bday = $_POST["bday"];
$service = $_POST["service"];
$dov = $_POST["dov"];
$email = $_POST["email"];
$phone = $_POST["phone"];

$sql = "INSERT INTO client_info (firstname, lastname, bday, service, dov, email, phone)
VALUES ('".$firstname."', '".$lastname."', '".$bday."', '".$service."', '".$dov."', '".$email."', '".$phone."')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>