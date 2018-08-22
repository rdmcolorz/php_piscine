#!/usr/bin/php
<?php
$i = 1;
$arr1 = array();
while ($argc > 1)
{
	$arr2 = preg_split('/\s+/', $argv[$i]);
	$arr1 = array_merge($arr1, $arr2);
	$argc--;
	$i++;
}
sort($arr1);
foreach ($arr1 as $value)
{
	echo "$value\n";
}
?>
