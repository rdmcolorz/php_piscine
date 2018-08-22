<?php
function ft_is_sort($arr)
{
	$default = $arr;
	sort($arr);
	foreach ($arr as $key=>$value)
	{
		if ($value!=$default[$key])
			return (0);
	}
	return (1);
}
?>
