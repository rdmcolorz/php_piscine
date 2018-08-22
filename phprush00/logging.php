<?php
function ob_file_callback($buffer)
{
  global $ob_file;
  fwrite($ob_file,$buffer);
}
function ft_log($str)
{
$ob_file = fopen('test.txt','w');

ob_start('ob_file_callback');

//Anything we output now will go to test.txt
echo $str;
ob_end_flush();
}
?>

