<?php
echo "Hello Zaz\n";
header('Content-type: image/png');
file_get_contents('42.png', '../img/42.png');
?>
