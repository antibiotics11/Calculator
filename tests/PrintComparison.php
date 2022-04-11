#!/usr/bin/php
<?php

	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
	include_once "../Calculation.class.php";
	
	$num1 = readline("\n num1 >> ");
	$num2 = readline("\n num2 >> ");

	$num1 = \Calculator\Binary::dec_to_bin($num1);
	$num2 = \Calculator\Binary::dec_to_bin($num2);

	echo "\n num1 : ".implode("", $num1);
	echo "\n num2 : ".implode("", $num2);
	echo PHP_EOL;

	$result = \Calculator\Comparison::compare_bin($num1, $num2);

	echo ($result) ? "\n num".$result." is bigger." : "\n num1 and num2 are same.";
	echo PHP_EOL;

