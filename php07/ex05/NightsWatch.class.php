<?php
class NightsWatch implements IFighter
{
	private $group = array();

	public function recruit($name)
	{
		$this->group[] = $name;
	}

	function fight()
	{
		foreach ($this->group as $fighter)
		{
			if (method_exists(get_class($fighter), "fight"))
				$fighter->fight();
		}
	}
}
?>
