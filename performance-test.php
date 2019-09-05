<?php
	require_once('MultiDimensionalArray.class.php');

	$i = 0;
	$l = 10;

	while ($l < 1000000000)
	{
		echo "-------------------------";
		echo "\n";
		echo `ansiprintf '%*3> - %rst> %*2>%32s%rst> %*1>%12d%rst>%ln>' 'items' $l`;
		echo "\n";

		$a = new MultiDimensionalArray($l, 1, 1);

		$i = 0;
		$t = microtime(true);
		while ($i < $l)
		{
				$a->push(rand(0,9));
				$i++;
		}
		$t_add_mda = microtime(true) - $t;

		echo `ansiprintf '%*3>MDA%rst> %*2>%32s%rst> %*1>%12.4f%rst>s%ln>' 'add (MDA)' $t_add_mda`;

		$i = 0;
		$t = microtime(true);
		$b = $a;
		while ($i < $l)
		{
			$a->pop();
			$i++;
		}
		$t_pop_mda = microtime(true) - $t;

		echo `ansiprintf '%*3>MDA%rst> %*2>%32s%rst> %*1>%12.4f%rst>s%ln>' 'pop (MDA)' $t_pop_mda`;

		// $i = 0;
		// $t = microtime(true);
		// $b->shift_mode_enable();
		// while ($i < $l)
		// {
		// 	$b->shift();
		// 	$i++;
		// }       
		// $b->shift_mode_disable();
		// $t_shift_mda = microtime(true) - $t;

		// echo `ansiprintf '%*3>MDA%rst> %*2>%32s%rst> %*1>%12.4f%rst>s%ln>' 'shift (MDA)' $t_shift_mda`;

		// $diff_mda = round($t_shift_mda / $t_pop_mda, 2);
	
		// echo "------------------ TEST NORMAL ARRAY ------------------";
		echo "\n";

		$a = [];

		$i = 0;
		$t = microtime(true);
		while ($i < $l)
		{
				$a[] = rand(0,9);
				$i++;
		}
		$t_add = microtime(true) - $t;

		echo `ansiprintf '%*3>Arr%rst> %*2>%32s%rst> %*1>%12.4f%rst>s%ln>' 'add (Arr)' $t_add`;

		$i = 0;
		$t = microtime(true);
		$b = array_reverse($a);
		while ($i < $l)
		{
				array_pop($b);
				$i++;
		}
		$t_pop = microtime(true) - $t;

		echo `ansiprintf '%*3>Arr%rst> %*2>%32s%rst> %*1>%12.4f%rst>s%ln>' 'reverse+pop (Arr)' $t_pop`;

		// $i = 0;
		// $t = microtime(true);
		// while ($i < $l)
		// {
		// 		array_shift($a);
		// 		$i++;
		// }       
		// $t_shift = microtime(true) - $t;
		// echo `ansiprintf '%*3>Arr%rst> %*2>%32s%rst> %*1>%12.4f%rst>s%ln>' 'shift (Arr)' $t_shift`;

		// $diff = round($t_shift / $t_pop, 2);  
		// $diff_3 = round($t_add_mda / $t_add, 2);  
		// $diff_2 = round($t_pop_mda / $t_pop, 2);  
		// $diff_1 = round($t_shift_mda / $t_pop, 2);  
		// $diff_0 = round($t_shift_mda / $t_shift, 2);  

		echo "\n";
		// echo `ansiprintf '%*3>MDA%rst> %*2>%32s%rst> %*1>%12.4f%rst>x faster than %*3>%s%rst>%ln>' 'pop (MDA)' $diff_mda 'shift (MDA)'`;
		// echo `ansiprintf '%*3>Arr%rst> %*2>%32s%rst> %*1>%12.4f%rst>x faster than %*3>%s%rst>%ln>' 'reverse+pop (Arr)' $diff 'shift (Arr)'`;
		echo "\n";
		// echo `ansiprintf '%*3> - %rst> %*2>%32s%rst> %*1>%12.4f%rst>x faster than %*3>%s%rst>%ln>' 'add (Arr)' $diff_3 'add (MDA)'`;
		// echo `ansiprintf '%*3> - %rst> %*2>%32s%rst> %*1>%12.4f%rst>x faster than %*3>%s%rst>%ln>' 'pop (Arr)' $diff_2 'pop (MDA)'`;
		// echo `ansiprintf '%*3> - %rst> %*2>%32s%rst> %*1>%12.4f%rst>x faster than %*3>%s%rst>%ln>' 'shift (Arr)' $diff_0 'shift (MDA)'`;
		// echo `ansiprintf '%*3> - %rst> %*2>%32s%rst> %*1>%12.4f%rst>x faster than %*3>%s%rst>%ln>' 'pop+reverse (Arr)' $diff_1 'shift (MDA)'`;

		echo "\n";

		$l *= 10;
	}
?>