#!/usr/bin/php
<?php

	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
	ini_set("memory_limit", "-1");	

	include_once "calculation.class.php";
	use calculator\calculation;
	
	class app {

		public static function main(): void {
			
			// CLI 환경이 아니면 강제종료
			if (strtolower(trim((string)php_sapi_name())) !== "cli") {
				echo " CLI only supported.".PHP_EOL;
				exit(0);
			}
			
			// "exit" 입력될때까지 무한루프
			while (true) {
				
				$expression = readline(PHP_EOL." >> ");
				
				if (strtolower($expression) == "exit") break;
				if (empty($expression)) continue;
				
				$calculation = new calculation($expression);
				$result = $calculation->get_result();

				echo chr(32).chr(61).chr(32).$result.PHP_EOL;
				
			}

			echo " Exiting...".PHP_EOL;

		}

	};

	app::main();
	
