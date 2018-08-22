<?php

require "products.php";

if ($_COOKIE[basket])
{
	$basket = unserialize($_COOKIE[basket]);
	$products = array();
	foreach ($basket as $name)
	{
		if ($products[$name])
		{
			$products[$name][quantity]++;
		}
		else
		{
			$price = get_price($name);
			$products[$name] = array("price"=>$price, "quantity"=>1);
		}
	}
	//print_r($products);
}
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="landstyle.css">
	<title>The Mutant-My Cart</title>
</head>
<body bgcolor="#682068">
<div class="list_container">
	<p class="title">Shopping Cart</p>
	<div class="list" style="color:white">
		<?php 
			if ($_COOKIE[basket])
			{
				foreach($products as $key => $product)
					echo $key." Qt: ".$product[quantity]." Price: $". $product[quantity] * $product[price] ."<br />";
			}
			else
				echo "Nothing in cart";
			$total_price = 0;
			foreach($products as $product)
			{
				$total_price += ($product[quantity] * $product[price]);
			}
			echo "<br>Total Price: $".$total_price;
		?>
	</div>
	<a href="/thankyou.php">
	<?php if (file_exists("./private/passwd"))
				echo "<input align="center" id="form" type="submit" value="CHECK OUT" />"; ?>
	</a>
	<a href="/index.php">
	<img align="center" id="slogo" src="./img/logo.jpg">
	</a>
</div>
</body>
</html>
