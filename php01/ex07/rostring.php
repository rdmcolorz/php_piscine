#!/usr/bin/php
<?php
if ($argc > 1)
{
	$arr = preg_split('/\s+/', trim($argv[1]));
	$len = count($arr) -1;
	$i = 0;
	$temp = $arr[0];
	while ($i < $len)
	{
		$arr[$i] = $arr[$i+1];
		$i++;
	}
	$arr[$len] = $temp;
	$count = $len + 1;	
	foreach ($arr as $value)
	{
		if (--$count <= 0)
			break ;
		echo "$value ";
	}
	echo "$arr[$len]\n";
}
?>
