
<?php
$servername='localhost';
$username='steinbergkarina';
$password='Jaaniuss112';
$dbname = "steinbergkarina_store";
$conn=mysqli_connect($servername,$username,$password,"$dbname");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}