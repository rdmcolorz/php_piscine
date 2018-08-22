<?php
Class Lannister
{
	public function sleepWith($fucked)
	{
		$fucker = $this->get_name();
		if ($fucker == "Tyrion")
		{
			if (get_parent_class($fucked) == "Lannister")
				print("Not even if I'm drunk !" . PHP_EOL);
			if (get_class($fucked) == "Sansa")
				print("Let's do this." . PHP_EOL);
		}
		if ($fucker == "Jaime")
		{
			if (get_class($fucked) == "Tyrion")
				print("Not even if I'm drunk !" . PHP_EOL);
			if (get_class($fucked) == "Sansa")
				print("Let's do this." . PHP_EOL);
			if (get_class($fucked) == "Cersei")
				print("With pleasure, but only in a tower in Winterfell, then." . PHP_EOL);
		}
	}
}
?>
