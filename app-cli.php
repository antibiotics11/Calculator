#!/usr/bin/php
<?php

	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
	ini_set("memory_limit", "-1");	

	include_once "Calculation.class.php";
	
	class app {
	
		public static function main(): void {
			
			if (strtolower(trim((string)php_sapi_name())) !== "cli") {
				echo " CLI only supported.".PHP_EOL;
				exit(0);
			}
			
			echo chr(32)."### 8-Bit Calculator by ANTIBIOTICS".PHP_EOL;
			echo chr(32)."### https://github.com/antibiotics11".PHP_EOL;
			
			$expression = "";

			while (strtolower(trim($expression)) !== "exit") {
				
				$expression = readline(" >> ");
				
				if (empty($expression)) continue;
				
				try {
				
					$calculation = new \Calculator\Calculation($expression);
					$result = $calculation->get_result();
					
					echo chr(32).chr(61);
					echo chr(32).(string)$result.PHP_EOL;
				
				} catch (Exception $e) {
					
					echo chr(32)."NOTICE: Unknown error occured. Please try again.".PHP_EOL;
										
				}
				
			}

			echo " Exiting...".PHP_EOL;

		}

	};

	app::main();

