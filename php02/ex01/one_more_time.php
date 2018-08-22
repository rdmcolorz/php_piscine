#!/usr/bin/php
<?php
date_default_timezone_set("Europe/Paris");
if ($argc > 1)
{
	$month = array("janvier", "février", "mars", "avril", "mai", "juin", 
"juillet", "août", "septembre", "octobre", "novembre", "décembre");
	$week = array("lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi",
"dimanche");
	$arr = preg_split('/\s+/', $argv[1]);
	if (count($arr) == 5)
	{
		if (in_array(strtolower($arr[0]), $week) && in_array(strtolower($arr[2]), $month))
		{
			$month_nmb = array_search(strtolower($arr[2]), $month) + 1;
			$time = explode(':', $arr[4]);
			if (count($time) == 3 && strlen($time[0]) == 2 &&
				strlen($time[1]) == 2 && strlen($time[2]) == 2 && strlen($arr[3]) == 4)
			{
				echo mktime($time[0], $time[1], $time[2], $month_nmb, $arr[1], $arr[3]);
				echo "\n";
			}
			else
			{
				echo "Wrong Format\n";
				return (0);
			}
		}
		else
			echo "Nope\n";
	}
	else
		echo "Wrong Format\n";
	
}
?>
