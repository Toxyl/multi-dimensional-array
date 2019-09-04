<?php
class MultiDimensionalArray
	{
		public $d; 		// data
		public $vpc; 	// valus_per_cell;
		public $rs; 	// rows
		public $cs; 	// cols
		public $c; 		// col
		public $r; 		// row
		public $cell; 	// cell index
		public $iv; 	// initial value
		public $shift_mode = false;

		public function __construct($cols, $rows = 1, $values_per_cell = 1, $initial_value = null)
		{
			$this->d = array_fill(0, $rows * ($cols * $values_per_cell), $initial_value);
			$this->c = 0;
			$this->r = 0;
			$this->cell = 0;
			$this->cs = $cols;
			$this->rs = $rows;
			$this->vpc = $values_per_cell;
			$this->iv = $initial_value;
		}

		public function index2cell()
		{
			$this->cell = $this->r * ($this->cs * $this->vpc) + ($this->c * $this->vpc);
		}

		public function cell2index()
		{
			$this->r = floor($this->cell / ($this->cs * $this->vpc));
			$this->c =       $this->cell - ($this->r  * $this->cs * $this->vpc);
		}

		public function set($c, $r, ... $vals)
		{
			$cnt = count($vals);
			if ($cnt % $this->vpc != 0)
			{
				$n = ceil($cnt / $this->vpc) - $cnt;
				$cnt += $n;
				while ($n > 0)
				{
					$vals[] = $this->iv;
					$n--;
				}
			}

			$this->c = $c;
			$this->r = $r;
			$this->index2cell();
			$vals = array_reverse($vals);
			$end = $this->cell + $cnt;
			while ($this->cell < $end)
			{
				$v = array_pop($vals);
				$this->d[$this->cell] = $v;
				$this->cell++;
			}
			$this->cell2index();
		}

		public function get($c, $r, $n_items = 1)
		{
			$this->c = $c;
			$this->r = $r;
			$this->index2cell();
			$out = [];
			$i = 0;
			while ($i < $n_items)
			{
				$out[] = array_slice($this->d, $this->cell, $this->vpc);
				$this->cell += $this->vpc;
				$i++;
			}
			return count($out) == 1 ? $out[0] : $out;
		}

		public function get_row($r)
		{
			return $this->get(0, $r, $this->cs);
		}

		public function shift_mode_disable()
		{
			if ($this->shift_mode)
			{
				$this->shift_mode = false;
				$this->d = array_reverse($this->d);
			}
		}

		public function shift_mode_enable()
		{
			if (!$this->shift_mode)
			{
				$this->shift_mode = true;
				$this->d = array_reverse($this->d);
			}
		}

		public function shift()
		{
			return $this->shift_mode ? array_pop($this->d) : array_shift($this->d);
		}

		public function push(... $vals)
		{
			$n = count($vals);
			if ($n == 1)
			{
				$this->d[] = $vals[0];

			}
			else
			{
				$vals = array_reverse($vals);
				while ($n > 0)
				{
					$this->d[] = array_pop($vals);
					$n--;
				}				
			}
		}

		public function pop()
		{
			return array_pop($this->d);
		}

		public function get_mapping_character($val)
		{
			return $val === $this->iv ? '□ ' : '■ ';
		}

		public function reduce_row($a, $b)
		{
			return $a === $this->iv && $b === $this->iv ? $this->iv : ($a !== $this->iv ? max($a, $b) : $b);
		}

		public function print_map()
		{
			$r = 0;
			while ($r < $this->rs)
			{
				$row = $this->get(0, $r, $this->cs, $this->vpc);
				if (!is_array($row))
				{
					$row = [ $row ];
				}	
				else
				{
					$row = array_map(
						function($a)
						{
							return array_reduce($a, [ $this, "reduce_row" ], $this->iv);
						},
						$row
					);
				}

				$row = array_map([$this, "get_mapping_character"], $row);
				echo implode('', $row) . "\n";
				$r++;
			}
		}

		public function print_map_values()
		{
			$r = 0;
			while ($r < $this->rs)
			{
				$row = $this->get(0, $r, $this->cs, $this->vpc);
				if (!is_array($row))
				{
					$row = [ $row ];
				}
				else
				{
					foreach ($row as &$row_val) 
					{
						$row_val = implode(' ', $row_val);
					}
				}

				echo implode(' | ', $row) . "\n";
				$r++;
			}
		}
	}
?>