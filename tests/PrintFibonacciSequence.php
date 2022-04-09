#!/bin/usr/php
<?php

	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
	include_once "../Calculation.class.php";
	use Calculator\Calculation;

	
	function Fibonacci(int $n): int {
		
		if ($n <= 1) { return $n; }
	
		$nm1 = (new Calculation($n."-1"))->get_result();
		$nm2 = (new Calculation($n."-2"))->get_result();

		$final = new Calculation((string)Fibonacci($nm1)."+".Fibonacci($nm2));

		return $final->get_result();
	
	}

	$n = readline(" n >> ");

	$start = microtime(true);

	echo "\n F(".$n.") = ".Fibonacci((int)$n).PHP_EOL;
	
	echo PHP_EOL;
	echo " **memory usage: ".memory_get_usage(true)." bytes".PHP_EOL;
	echo " **execution time: ".round((microtime(true) - $start), 5)." secs".PHP_EOL;

