<?php
	require_once('MultiDimensionalArray.class.php');
	
	$i = 0;
	$l = 11;
	$a = new MultiDimensionalArray($l, $l, 1);
	while ($i < $l)
	{
		$j = 0;
		while ($j < $l)
		{
			$a->set($j, 			$i, [null,true][round(rand(0,1))]);

			$j++;
		}
		$i++;
	}
	$a->print_map();
?>

