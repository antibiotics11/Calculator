<?php
	namespace calculator;
	
	const _SRC_ = __DIR__.DIRECTORY_SEPARATOR."classes".DIRECTORY_SEPARATOR;
	const _EXT_ = ".class.php";
	
	include_once _SRC_."binary"._EXT_;
	include_once _SRC_."complement"._EXT_;
	include_once _SRC_."exception"._EXT_;
	include_once _SRC_."expression"._EXT_;
	include_once _SRC_."stack"._EXT_;
	include_once _SRC_."addition.calculation"._EXT_;
	include_once _SRC_."subtraction.calculation"._EXT_;
	include_once _SRC_."multiplication.calculation"._EXT_;
	include_once _SRC_."division.calculation"._EXT_;
	
	
	class calculation {


		private $postfix = array();


		private $result = NULL;
		
		
		/**
		 * 후위표기식 배열을 순서대로 읽으면서 연산 
		 */
		private function calculate(array $expression): string {
			
			$expression_length = count($expression);
			$stack = new stack($expression_length);
			
			for ($i = 0; $i < $expression_length; $i++) {
				
				if (is_numeric($expression[$i])) {
					
					$stack->push($expression[$i]);
					continue;
					
				}
					
				$num2 = \calculator\binary::dec_to_bin($stack->peek());
				$stack->pop();
					
				$num1 = \calculator\binary::dec_to_bin($stack->peek());
				$stack->pop();
				
				if ($expression[$i] == chr(43)) {
					
					$result = \calculator\calculation\addition::add($num1, $num2);	
					
				} else if ($expression[$i] == chr(45)) {
					
					$result = \calculator\calculation\subtraction::subtract($num1, $num2);	
					
				} else if ($expression[$i] == chr(42)) {
					
					$result = \calculator\calculation\multiplication::multiply($num1, $num2);
				
				} else if (expression[$i] == chr(47)) {
					
					$result = \calculator\calculation\division::divide($num1, $num2);
					
				}
				
				// 연산 결과를 10진수를 변환하여 스택에 삽입
				$stack->push(binary::bin_to_dec($result));
				// 부호 비트가 음수면 "-" 연산자를 스택에 삽입
				if ($result[__MAXBIT__]) {
					$stack->push(chr(45));
				}
				
			}
			
			$last = $stack->peek();
			
			if (gettype($last) !== "integer") {
				$stack->pop();
				$last = $last.$stack->peek();
			}
			
			return (string)$last;
			
		}
		
		
		public function __construct(string $expression) {
			
			$expression = new expression($expression);
			$this->postfix = $expression->get_postfix();
			$this->result = $this->calculate($this->postfix);
			
		}
		
		
		public function get_result(): int {
			
			return $this->result;
			
		}
		
		
	};
	