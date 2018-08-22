#!/usr/bin/php
<?php
$content = file_get_contents($argv[1]);
$arr = str_split($content);
$len = count($arr);
$i = 0;
$new = "";
$flag = 0;
while ($i < $len)
{
	if ($arr[$i] == '<' && ($arr[$i+1] == 'A' || $arr[$i+1] == 'a') || $arr[$i] == '=')
		$flag = 1;
	while ($flag == 1 && $i < $len)
	{
		if ($arr[$i] == '>' || $arr[$i] == '"')
			$flag = 2;
		while ($flag == 2 && $i < $len)
		{
			$i++;
			$arr[$i] = strtoupper($arr[$i]);
			if ($arr[$i] == '<')
				$flag = 0;
		}
		$i++;
	}
	$i++;
}
foreach ($arr as $value)
echo "$value";
?>
