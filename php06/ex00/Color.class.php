<?php
Class Color 
{
	public $red;
	public $green;
	public $blue;
	static $verbose = false;
	
	public function __construct(array $arr)
	{
		if (array_key_exists("rgb", $arr))
		{
			$nb = $arr['rgb'];
			$red  = floor($nb / 65536);
			$nb = $nb - $red * 65536;
			$green = floor($nb / 256);
			$blue = $nb - $green * 256;
			print "Color( red:".str_pad($red, 4, " ", STR_PAD_LEFT).
					", green:".str_pad($green, 4, " ", STR_PAD_LEFT).
					", blue:".str_pad($blue, 4, " ", STR_PAD_LEFT)." ) constructed.\n";
		}
		else
		{
			$red = $arr['red'];
			$green = $arr['green'];
			$blue = $arr['blue'];
			print "Color( red:".str_pad($red, 4, " ", STR_PAD_LEFT).
					", green:".str_pad($green, 4, " ", STR_PAD_LEFT).
					", blue:".str_pad($blue, 4, " ", STR_PAD_LEFT)." ) constructed.\n";
		}

	}
	function __toString()
	{
	}
	function doc()
	{
	}
	function add()
	{
	}
	function sub()
	{
	}
	function mult()
	{
	}
}

$color = new Color(array('red' => 0xff, 'green' => 0, 'blue' => 0xee));
?>
