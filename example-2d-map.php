<?php
	require_once('MultiDimensionalArray.class.php');

	$i = 0;
	$l = 11;
	$a = new MultiDimensionalArray($l, $l, 3);
	while ($i < $l)
	{
		$a->set($i, $i, $i, $i+1, $i+2);
		$a->set($l-$i-1, $i, $i, $i+1, $i+2);
		$i++;
	}
	$a->print_map();
?>

