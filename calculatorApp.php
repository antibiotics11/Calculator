<?php
	namespace calculator;
	include_once "calculation.php";
	include_once "expression.php";
	include_once "utils.php";
	
	class calculatorApp {
		
		/** 계산 결과 */
		private $calculation_result;
		
		/** 수식을 계산 */
		private function calculate(array $expression): int {
			
			$expression_length = count($expression);
			$calculate = new stack($expression_length);
			
			for ($i = 0; $i < $expression_length; $i++) {
				
				if (is_numeric($expression[$i])) {
					$calculate->push($expression[$i]);
				} else {
					$num2 = binary::dec_to_bin($calculate->get_top());
					$calculate->pop();
					$num1 = binary::dec_to_bin($calculate->get_top());
					$calculate->pop();
					
					// 덧셈
					if ($expression[$i] == chr(43)) {
						$result = calculation::add($num1, $num2);
						$calculate->push(binary::bin_to_dec($result));
						
					// 뺄셈
					} else if ($expression[$i] == chr(45)) {
					
					// 곱셈
					} else if ($expression[$i] == chr(42)) {
						
					// 나눗셈
					} else if ($expression[$i] == chr(47)) {
						
					}
					
				}
				
			}

			return $calculate->get_top();
			
		}
		
		
		public function __construct(string $expression) {
			
			$exp = new expression($expression);
			
			$postfix = $exp->get_postfix();
			//echo implode(chr(32), $postfix);
			$this->calculation_result = $this->calculate($postfix);
			
		}
		
		
		/** 계산 결과를 최종적으로 반환 */
		public function get_result() {
			
			return $this->calculation_result;
			
		}
		
	};
	