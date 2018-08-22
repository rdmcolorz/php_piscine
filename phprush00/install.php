<?php
require "logging.php";

function add_product($conn, string $name, float $price, string $description)
{
	$sql = "INSERT INTO PRODUCTS (name, price, description) 
		VALUES ('{$name}', {$price}, '{$description}')";
	if ($conn->query($sql) === TRUE) 
	{
    	ft_log("New record created successfully\n");
	}
	else 
	{
    	ft_log("Error: " . $sql . "<br>" . $conn->error);
	}
}

/* INITIALIZE DB */
$host 		=	"127.0.0.1";
$user		=	"root";
$password 	=	"root";
$db 		=	"store_db";
$port 		=	8889;

// Create connection
$conn = mysqli_connect(
	$host,
	$user,
	$password,
	"",
	$port
);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database
$sql = "CREATE DATABASE {$db}";
if (mysqli_query($conn, $sql)) {
    ft_log("Database created successfully\n");
} else {
    ft_log("Error creating database: " . mysqli_error($conn) . "\n");
}

mysqli_close($conn);

// Connect to store_db
$conn = mysqli_connect(
	$host,
	$user,
	$password,
	$db,
	$port
);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create tables

// PRODUCTS table
$table_name = "PRODUCTS";
$sql = "CREATE TABLE ${table_name} (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
name VARCHAR(30) NOT NULL,
price DECIMAL(6,2) NOT NULL,
description VARCHAR(200) NOT NULL,
reg_date TIMESTAMP
)";

if (mysqli_query($conn, $sql)) 
{
	ft_log("Table {$table_name} created successfully\n");
	add_product($conn, "Super Smarts", 100.00, "Because we cant all be Andy Shih");
	add_product($conn, "Norme Vision", 25.00, "Norme Error. Nro Probrem.");
	add_product($conn, "Black Hole", 250.00, "Eat food, but dont get fat.");
} 
else 
{
    ft_log("Error creating table: " . mysqli_error($conn) . "\n");
}

mysqli_close($conn);

?>
