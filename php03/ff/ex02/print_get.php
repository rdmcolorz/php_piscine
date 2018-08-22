<?php
/*
$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$stuff = parse_url($url, PHP_URL_QUERY);
$arr = explode("&", $stuff);
foreach($arr as $ele)
{
	$ele = str_replace("=", ": ", $ele);
	echo "$ele\n";
}
*/
    if ($_GET != 0)
    {
        foreach ($_GET as $arg => $value) //get values from key using '=>'
            echo $arg.": ".$value."\n"; // '.' concatenates string.
    }
?>
