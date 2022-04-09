<?php
	namespace Calculator\Calculation;
	if (!defined(__MAXBIT__)) define("__MAXBIT__", 8);

	class Multiplication {
		
		/** 곱셈 */
		public static function multiply(array $num1, array $num2): array {
			
			$partial_product = array();
			
			// 피승수와 승수의 각 비트를 AND 연산하여 결과를 부분곱 배열에 입력
			for ($i = 0; $i <= __MAXBIT__; $i++) {
				for ($j = $i, $k = 0; $j <= __MAXBIT__; $j++, $k++) {
					
					$partial_product[$i][$j] = ($num2[$i] && $num1[$k]) ? 1 : 0; 
					
				}
			}
			
			// result를 일단 0으로 설정
			$result = \Calculator\Binary::dec_to_bin(0);
			
			for ($k = 0; $k <= __MAXBIT__; $k++) {
				
				// 각 부분곱의 부분합을 계산하여 result에 입력
				$result = \Calculator\Calculation\Addition::add($partial_product[$k], $result);
				
			}
			
			return $result;
		
		}
		
	};
	