#!/usr/bin/php
<?php

	@error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING); 
	
	include_once "calculatorApp.php";
	
	if (strtolower(trim(php_sapi_name())) != "cli") {
		throw new Exception("Cli only supported.");
	}
	
	while (true) {
		
		$expression = readline(PHP_EOL." >> ");
		
		if (strtolower($expression) == "exit") {
			break;
		}
		
		if (empty($expression)) {
			errors::exception("No input expressions.");
			continue;
		}
		
		$cal = new calculator\calculatorApp($expression);
		echo PHP_EOL.$cal->get_result();

	}
	
	echo PHP_EOL." Exiting...";