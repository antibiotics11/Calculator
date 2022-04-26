<?php
	namespace Calculator\Calculation;
	if (!defined("__MAXBIT__")) define("__MAXBIT__", 8);

	class Multiplication {
		
		/** 곱셈 */
		public static function multiply(array $num1, array $num2): array {
			
			$partial_product = array();
			
			for ($i = 0; $i <= __MAXBIT__; $i++) {
				
				$partial_product[$i] = \Calculator\Binary::dec_to_bin(0);
				
				for ($j = $i, $k = 0; $j < __MAXBIT__; $j++, $k++) {
					
					// 피승수와 승수의 각 비트를 AND 연산하여 결과를 부분곱 배열에 입력
					$partial_product[$i][$j] = \Calculator\LogicGate::AND($num2[$i], $num1[$k]);
					
				}
			}
			
			$result = \Calculator\Binary::dec_to_bin(0);
			
			for ($k = 0; $k <= __MAXBIT__; $k++) {
				
				// 각 부분곱의 부분합을 계산하여 result에 입력
				$result = \Calculator\Calculation\Addition::add($partial_product[$k], $result);
				
			}
			
			return $result;
		
		}
		
	};
	
