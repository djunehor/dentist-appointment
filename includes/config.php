<?php
error_reporting(0);
//database variables
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dentist";

// Create connection
$con = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con->connect_error) {
    die("Error: Connection failed-> " . $con->connect_error);
 }
$website_name = "The Dentist";
if(!session_id()) {
session_start();
}
?>