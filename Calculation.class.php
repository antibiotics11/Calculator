<?php
	namespace Calculator;
	
	const _SRC_ = __DIR__.DIRECTORY_SEPARATOR."classes".DIRECTORY_SEPARATOR;
	const _EXT_ = ".class.php";
	const __MAXBIT__ = 8;
	
	include_once _SRC_."Binary"._EXT_;
	include_once _SRC_."Complement"._EXT_;
	include_once _SRC_."Exception"._EXT_;
	include_once _SRC_."Expression"._EXT_;
	include_once _SRC_."Stack"._EXT_;
	include_once _SRC_."Addition.Calculation"._EXT_;
	include_once _SRC_."Subtraction.Calculation"._EXT_;
	include_once _SRC_."Multiplication.Calculation"._EXT_;
	include_once _SRC_."Division.Calculation"._EXT_;
	
	
	class Calculation {

		private $postfix = array();

		private $result = NULL;
		
		/** 후위표기식 배열을 순서대로 읽으면서 연산 */
		private function calculate(array $expression): string {
			
			$expression_length = count($expression);
			$stack = new \Calculator\Stack($expression_length);

			for ($i = 0; $i < $expression_length; $i++) {
				
				if (is_numeric($expression[$i])) {
					
					$stack->push($expression[$i]);
					continue;
					
				}
					
				$num2 = \Calculator\Binary::dec_to_bin($stack->peek());
				$stack->pop();
					
				$num1 = \Calculator\Binary::dec_to_bin($stack->peek());
				$stack->pop();
				
				if ($expression[$i] == chr(43)) {
					
					$result = \Calculator\Calculation\Addition::add($num1, $num2);	
					
				} else if ($expression[$i] == chr(45)) {

					$result = \Calculator\Calculation\Subtraction::subtract2($num1, $num2);

					//$result = \Calculator\Calculation\Subtraction::subtract1($num1, $num2);	
					
				} else if ($expression[$i] == chr(42)) {
					
					$result = \Calculator\Calculation\Multiplication::multiply($num1, $num2);
				
				} else if (expression[$i] == chr(47)) {
					
					$result = \Calculator\Calculation\Division::divide($num1, $num2);
					
				}
				
				// 연산 결과를 10진수를 변환하여 스택에 삽입
				$stack->push(\Calculator\Binary::bin_to_dec($result));
				
				// 부호 비트가 음수면 "-" 연산자를 스택에 삽입
				if ($result[__MAXBIT__]) $stack->push(chr(45));
				
			}
			
			$last = $stack->peek();

			// 스택의 마지막 요소가 정수가 아니면 무시하고 제거
			if (trim(gettype($last)) !== "integer") {
				$stack->pop();
				$last = $last.$stack->peek();
			}
			
			return (string)$last;
			
		}
		
		
		public function __construct(string $infix_expression) {
			
			$expression = new \Calculator\Expression($infix_expression);
			
			try {
				
				$this->postfix = $expression->get_postfix();
				$this->result = $this->calculate($this->postfix);
			
			} catch (Exception $e) {
				
				\Calculator\Errors::exception($e);
				
			}
			
		}
		
		
		public function get_result(): int {
			
			return $this->result;
			
		}
		
		
	};
	
