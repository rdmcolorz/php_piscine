#!/usr/bin/php
<?php
date_default_timezone_set("Europe/Paris");
$content = file_get_contents('/var/run/utmpx');
$len = strlen($content);
$arr = str_split($content, 628);
$arr = array_slice($arr, 2, 7);
$final = array();
foreach($arr as $value)
{
	$tab = array();
	$value = unpack("a256user/lid/a32tty/lpid/sstatus/sunknown/ltimestamp/lmicro/a256hostname/a64pad", $value);	
	$tab[] = "$value[user]    ";
	$tab[] = "$value[tty] ";
	$tab[] = date(" M d H:m\n", "$value[timestamp]");
	$final[] = $tab;
}
function cmp($a, $b)
{
	return $a[1] - $b[1];
}
//$final = usort($final, "cmp");
foreach ($final as $print)
{
	foreach($print as $ee)
		echo $ee;
}
?>
