<?php
$servername='localhost';
$username='root';
$password="qwerty";
$dbname = "game";
$conn=mysqli_connect($servername,$username,$password,"$dbname");
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);}
$product_id = 2; // Assuming you want the product with ID 2
$query = "SELECT username FROM users WHERE id = $product_id";

// Execute the query
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['username'];
} else {
    $name = "Product not found"; // Handle the case where the query fails
}

// Close the database connection
mysqli_close($conn);
?>
<html lang="en">
<head>
    <title>My store</title>
</head>
<body>
<h1>Tereeee</h1>
<h2><?php echo $name; ?></h2>
</body>
</html>
