<?php
session_start();
$login = $_GET[login];
$passwd = $_GET[passwd];
$submit = $_GET[submit];

$_SESSION[submit] = $submit;
if ($submit == "OK")
{
	$_SESSION[login] = $login;
	$_SESSION[passwd] = $passwd;
}
?>
<html><body>
<form>
	Username: <input name="login" value="<?php echo $_SESSION[login]; ?>"/>
	<br />
	Password:  <input name="passwd" value="<?php echo $_SESSION[passwd]; ?>"/>
	<input type="submit" name="submit" value="OK"/>
</form>
</body></html>
