#!/usr/bin/php
<?php
echo "Enter a number: ";
while ($str = fgets(STDIN))
{
	$str = substr($str, 0, -1);
	if (is_numeric($str))
	{
		$nb = (int)$str;
		if ($nb % 2 == 0)
			echo "The number $nb is even\n";
		else
			echo "The number $nb is odd\n";
	}
	else
		echo "'$str' is not a number\n";
	echo "Enter a number: ";
}
echo "^D\n";
?>
