#!/usr/bin/php
<?php

	include_once "classes/LogicGate.class.php";
	use Calculator\LogicGate;

	$operations = array(
		
		"AND",
		"OR",
		"NAND",
		"NOR",
		"XNOR",
		"XOR"

	);

	foreach ($operations as $name) {

		echo "===".chr(32).$name.PHP_EOL;
		echo "A | B | result".PHP_EOL;
		
		$a = 1; $b = 1;
		$result = LogicGate::{$name}($a, $b);
		echo $a." | ".$b." | ".$result.PHP_EOL;

		$a = 1; $b = 0;
		$result = LogicGate::{$name}($a, $b);
		echo $a." | ".$b." | ".$result.PHP_EOL;

		$a = 0; $b = 1;
		$result = LogicGate::{$name}($a, $b);
		echo $a." | ".$b." | ".$result.PHP_EOL;

		$a = 0; $b = 0;
		$result = LogicGate::{$name}($a, $b);
		echo $a." | ".$b." | ".$result.PHP_EOL;

		echo PHP_EOL;

	}

