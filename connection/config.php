<?php
session_start();
$hostname = "http://localhost/ecommerc/";

$conn = new mysqli("localhost", "root", "", "ecommerce");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
function show($data)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}
?>