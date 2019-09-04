<?php
	require_once('MultiDimensionalArray.class.php');

	class RGBImage extends MultiDimensionalArray
	{
		public function __construct($cols, $rows)
		{
			 parent::__construct($cols, $rows, 3, 0x00);
		}

		public function set_color($col, $row, $color)
		{
			$r = ($color & 0xFF0000) >> 16;
			$g = ($color & 0x00FF00) >> 8;
			$b = ($color & 0x0000FF);
			parent::set($col, $row, $r, $g, $b);
		}

		public function get_color($col, $row)
		{
			$color = parent::get($col, $row, 1);
			if ($color != $this->iv)
			{
				$color = (($color[0] << 16) | $color[1] << 8) | $color[2];
			}
			return $color;
		}

		public function print_map_values()
		{
			echo "\n";
			$r = 0;
			while ($r < $this->rs)
			{
				echo "│";
				$c = 0;
				while ($c < $this->cs)
				{
					$color = $this->get_color($c, $r);
					$char = $c == $this->cs - 1 ? '┤' : '│';
					echo $color == $this->iv ? ' ┈┈┈┈┈┈┈┈ ' . $char : sprintf(' 0x%06s ' . $char, dechex($color));
					$c++;
				}
				echo "\n";
				$r++;
			}
			echo "\n";
		}
	}

	$i = 0;
	$l = 11;
	$a = new RGBImage($l, $l);
	while ($i < $l)
	{
		$a->set_color($i, 		$i, 0xFFCC00);
		$a->set_color($l-$i-1, 	$i, 0x00CCFF);

		$i++;
	}

	$a->print_map();
	$a->print_map_values();

?>

