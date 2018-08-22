<?php
if (file_exists("../private") == FALSE)
{
	mkdir("../private");
}
if ($_POST[submit] == "OK" && $_POST[login] && $_POST[oldpw] && $_POST[newpw])
{
	$login = $_POST[login];
	$old_users = unserialize(file_get_contents("../private/passwd"));
	if (file_exists("../private/passwd"))
	{
		foreach ($old_users as $user)
		{
			if ($user[login] == $_POST[login])
			{
				if ($user[passwd] == hash('whirlpool', $_POST[oldpw]))
				{
					$user[passwd] = hash('whirlpool', $_POST[newpw]);
					$old_users = serialize($old_users);
					file_put_contents("../private/passwd", $old_users);
					echo "OK\n";
					return (0);
				}
			}
		}
		echo "ERROR\n";
	}
}
else
	echo "ERROR\n";
?>
