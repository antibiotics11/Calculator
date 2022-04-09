<?php

	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
	include_once "../Calculation.class.php";

	echo PHP_EOL."====================== Multiplication Table ======================".PHP_EOL;

	for ($i = 1; $i <= 9; $i++) {
		for($j = 1; $j <= 9; $j++) {

			$expression = (string)($i."*".$j);

			try {

				$calc = new \Calculator\Calculation($expression);
				$result = $calc->get_result();

			} catch (Exception $e) {

				echo $e.PHP_EOL;

			}

			echo $expression."=".$result.chr(9);

			$calc = NULL;

		}

		echo PHP_EOL;

	}

	echo PHP_EOL."memory usage: ";
	echo memory_get_usage(true)." bytes".PHP_EOL;
	//echo round(memory_get_usage(true) / 1024, 2)." kb".PHP_EOL;
