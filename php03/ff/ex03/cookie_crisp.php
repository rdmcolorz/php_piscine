<?php
$flag = 0;
$arr = $_GET;
$name = $_GET[name];
$value = $_GET[value];
if ($arr)
{
	if ($_GET[action] == 'set')
		setcookie($name, $value, time()+3600);
	if ($_GET[action] == 'del')
		setcookie($name, $value, time()-3600);
	if ($_GET[action] == 'get')
		if ($_COOKIE[$name])
			echo $_COOKIE[$name]."\n";
}
?>
