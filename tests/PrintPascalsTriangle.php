#!/usr/bin/php
<?php

	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
	include_once "../Calculation.class.php";
	use \Calculator\{Calculation, LogicGate};
	
	function Pascal(int $n): void {
		
		$triangle = array();
		
		for ($i = 0; $i < $n; $i = (new Calculation($i."+1"))->get_result()) {
			for ($j = 0; $j < $n; $j = (new Calculation($j."+1"))->get_result()) {
				
				if (LogicGate::NOR($j, 0) || Logicgate::XNOR($i, $j)) {
					
					$triangle[$i][$j] = 1;
				
				} else {
					
					$im1 = (new Calculation($i."-1"))->get_result();
					$jm1 = (new Calculation($j."-1"))->get_result();
					
					$num1 = ($triangle[$im1][$jm1]) ? $triangle[$im1][$jm1] : 0;
					$num2 = ($triangle[$im1][$j]) ? $triangle[$im1][$j] : 0;
					$triangle[$i][$j] = (new Calculation($num1."+".$num2))->get_result();
				
				}
				
				echo ($triangle[$i][$j]) ? $triangle[$i][$j].chr(32) : "";
				
			}
			
			echo PHP_EOL;
			
		}
		
	}
	
	$n = readline(" n >> ");
	
	$start = microtime(true);
	Pascal($n);

	echo PHP_EOL;
	echo " **memory usage: ".memory_get_usage(true)." bytes".PHP_EOL;
	echo " **execution time: ".round((microtime(true) - $start), 5)." secs".PHP_EOL;
