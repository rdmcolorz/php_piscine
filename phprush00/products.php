<?php

require "mysqli_procedural_wrapper.php";

function get_products($category = "")
{
	$sql = "SELECT id, name, price, description FROM PRODUCTS";
	return db_select($sql);
}

function get_price(string $name)
{
	$sql = "SELECT price FROM PRODUCTS WHERE name='{$name}'";
	$row = db_select($sql);
	return $row[0][price];
}
?>
