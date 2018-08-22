<?php
require "install.php";
require "products.php";

$product_arr = get_products();
$new_item = $_POST[product_name];
$basket = array();
$host_url = "http://".$_SERVER[HTTP_HOST];
if ($_POST[add_product] == '+')
{
	if (isset($_COOKIE[basket]))
	{
		$basket = unserialize($_COOKIE[basket]);
		$basket[] = $new_item;
		setcookie("basket", serialize($basket), time()+3600);
	}
	else
	{
		$basket[] = $new_item;
		setcookie("basket", serialize($basket), time()+3600);
	}
}
//print_r($basket);
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo $host_url.'/landstyle.css'?>">
	<title>The Mutant</title>
</head>
<body bgcolor="#682068">
<div align="center">
<img text-align="center" id="logo" alt="logo" src="<?php echo $host_url.'/img/logo.jpg'?>"/>
<table align="middle" style="table";>
	<tr bgcolor="#682068">
		<td>
			<form action="<?php echo $host_url.'/signup.php'?>">
				<input id="soon"  type="submit" value="Sign Up!"/>
			</form>
		</td>
		<td>
			<form action="<?php echo $host_url.'/cart.php'?>">
				<input id="soon" type="submit" value="My Cart"/>
			</form>
		</td>
		<td>
			<form action="<?php echo $host_url.'/soon.html'?>">
				<input id="form" type="submit" value="Coming Soon"/>
			</form>
		</td>
		<td>
			<form action="<?php echo $host_url.'/soon.html'?>">
				<input id="form" type="submit" value="Coming Soon"/>
			</form>
		</td>
		</tr>
</table>
<?php
foreach ($product_arr as $product)
{
echo "<div class='item'>
	<font face='helvetica'>
	<div class='title'>{$product['name']}</div><div class='cat'>CLASS A $ {$product['price']} USD</div>
	<div class='paragraph'>{$product[description]}</div>
	<form action='index.php' method='post'>
		<input type='radio' name='product_name' value='{$product['name']}' checked style='display:none'>
		<input class='add' type='submit' name='add_product' value='+'>
	</form>
</div>";
}
?>
</body>
</html>
