<?php
if (file_exists("./private") == FALSE)
{
    mkdir("./private");
}
if ($_POST[submit] == "OK" && $_POST[login] && $_POST[passwd])
{
    $login = $_POST[login];
    $old_users = unserialize(file_get_contents("./private/passwd"));       
	if (file_exists("./private/passwd"))
    {
        foreach ($old_users as $user)
        {
            if ($user[login] == $_POST[login])
            {
                echo "ERROR USER EXISTS\n";
                return (0);
            }
        }
        $_POST[passwd] = hash('whirlpool', $_POST[passwd]);
        $old_users[] = array("login"=>$login, "passwd"=>$_POST[passwd]);
        $old_users = serialize($old_users);
		file_put_contents("./private/passwd", $old_users);
		echo "USER CREATED - go <a href='./index.php/'>home</a>";
        return (0);
    }
    $_POST[passwd] = hash('whirlpool', $_POST[passwd]);
    $account = unserialize(file_get_contents("./private/passwd"));
    $account[] = array("login"=>$login, "passwd"=>$_POST[passwd]);
    $account = serialize($account);
    file_put_contents("./private/passwd", $account);
	echo "USER CREATED - go <a href='./index.php/'>home</a>";
}
else
	echo "ERROR\n";
?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="landstyle.css">
	<title>The Mutant-Sign up</title>
</head>
<body bgcolor="#682068">
<div class="container">
	<p id="title">ARE YOU A HERO OR VILLAN?</p>
	<form action="signup.php" method="post">
	<p id="word">USERNAME :</p>
	<br />
	</><input id="input" name="login" value=""/>
	<br />
	<p id="word">PASSWORD :</p>
	<br />
	<input id="input" name="passwd" value=""/>
	<input id="form" type="submit" name="submit" value="OK"/>
	</form>
	<a href="/index.php">
	<img align="middle" id="slogo" src="./img/logo.jpg">
	</a>
</div>
</body>
</html>
