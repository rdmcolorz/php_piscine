#!/usr/bin/php
<?php
$arr1 = array();
function cmp($a, $b)
{
	echo "$a $b\n";
}
$i = 1;
while ($argc > 1)
{
	$arr2 = preg_split('/\s+/', $argv[$i]);
	$arr1 = array_merge($arr1, $arr2);
	$argc--;
	$i++;
}
natcasesort($arr1);
//usort($arr1, 'cmp');
//$arr1 = array_reverse($arr1); 
foreach ($arr1 as $value)
{
	echo "$value\n";
}
?>
