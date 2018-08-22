<?php
function ft_split($str)
{
	$arr = preg_split('/\s+/', $str);
	$len = count($arr) - 1;
	$temp = $arr[$len];
	$i = 1;
	while ($len > 0)
	{
		$arr[$len] = $arr[$len-1];
		$len--;
	}
	$arr[0] = $temp;
	return ($arr);
}
?>
