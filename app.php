#!/usr/bin/php
<?php
	
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING); 
	
	include_once "calculation.php";
	include_once "expression.php";
	include_once "utils.php";
	
	use calculator\{stack, binary, expression, calculation};

	class app {

		private $result;
		
		private function calculate(array $expression): int {
			
			$expression_length = count($expression);
			$stack = new stack($expression_length);
			
			for ($i = 0; $i < $expression_length; $i++) {
				
				if (is_numeric($expression[$i])) {
					
					$stack->push($expression[$i]);
					
				} else {
					
					$num2 = binary::dec_to_bin($stack->peek());
					$stack->pop();
					
					$num1 = binary::dec_to_bin($stack->peek());
					$stack->pop();
					
					if ($expression[$i] == chr(43)) {
						$result = calculation::add($num1, $num2);
					} else if ($expression[$i] == chr(45)) {
						$result = calculation::subtract($num1, $num2);					
					} else if ($expression[$i] == chr(42)) {
						$result = calculation::multiply($num1, $num2);
					} else if ($expression[$i] == chr(47)) {
						$result = calculation::divide($num1, $num2);
					}
					
					$stack->push(binary::bin_to_dec($result));
					
				}
				
			}

			return $stack->peek();
			
		}
		
		public function __construct(string $expression) {
			
			$exp = new expression($expression);
			$postfix = $exp->get_postfix();
			$this->result = $this->calculate($postfix);
			
		}
		
		public function get_result(): int {
			
			return $this->result;
			
		}
		
		public static function main(): void {
			
			if (strtolower(trim(php_sapi_name())) != "cli") {
				throw new Exception("Cli only supported.");
			}
			
			while (true) {
				
				$expression = readline(PHP_EOL." >> ");
				
				if (strtolower($expression) == "exit") break;
				if (empty($expression)) continue;
				
				$calculation = new app($expression);
				$result = $calculation->get_result();

				echo chr(32).chr(61).chr(32).$result.PHP_EOL;
			}
			
		}
		
	};
	
	app::main();
	