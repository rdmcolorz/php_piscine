<?php
if (file_exists("../private") == FALSE)
{
	mkdir("../private");
}
if ($_POST[submit] == "OK" && $_POST[login] && $_POST[passwd])
{
	$login = $_POST[login];
	$old_users = unserialize(file_get_contents("../private/passwd"));
	if (file_exists("../private/passwd"))
	{
		foreach ($old_users as $user)
		{
			if ($user[login] == $_POST[login])
			{
				echo "ERROR\n";
				return (0);
			}
		}
		$_POST[passwd] = hash('whirlpool', $_POST[passwd]);
		$old_users[] = array("login"=>$login, "passwd"=>$_POST[passwd]);
		$old_users = serialize($old_users);
		file_put_contents("../private/passwd", $old_users);
		echo "OK\n";
		return (0);
	}
	$_POST[passwd] = hash('whirlpool', $_POST[passwd]);
	$account = file_get_contents("../private/passwd");
	$account[] = array("login"=>$login, "passwd"=>$_POST[passwd]);
	$account = serialize($account);
	file_put_contents("../private/passwd", $account);
	echo "OK\n";
}
else
	echo "ERROR\n";
?>
