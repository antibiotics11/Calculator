<?php

	namespace calculator;
	
	if (!defined("__MAXBIT__")) define("__MAXBIT__", 64);
	
	
	class binary {
		
		/** 10진수가 최댓값을 넘는지 확인 */
		public static function dec_exceed(int $num): bool {
			
			return (count(binary::dec_to_bin($num)) <= __MAXBIT__) ? false : true;
			
		}
		
		/** 2진 배열이 최댓값을 넘는지 확인 */
		public static function bin_exceed(array $num): bool {
			
			return (count($num) <= __MAXBIT__) ? false : true;
			
		}
		
		/** 10진수를 2진 배열로 반환 */
		public static function dec_to_bin(int $num): array {
			
			$result = array();
			
			for ($i = __MAXBIT__ - 1; $i >= 0; $i--) {
				
				$result[$i] = $num >> $i & 1;
				
			}
			
			return $result; 
		}
		
		/** 2진 배열을 10진수로 반환 */
		public static function bin_to_dec(array $num): int {
			
			$position = __MAXBIT__ - 1;
			$result = 0;
			
			for ($i = __MAXBIT__ - 1; $i >= 0; $i--) {
				
				if ($num[$i] == 1) {
					$result += 1 << $position;
				}
				$position--;
				
			}
			
			return $result;
		}
		
	};
	
	
	class complement {
		
		/** 1의 보수 계산 */
		public static function get_1s_complement(array $num): array {
			
			$result = array();
			$continued = true;
			
			for ($i = __MAXBIT__ - 1; $i >= 0; $i--) {
				
				if ($continued && $num[$i] == 0) {
					
					$result[$i] = 0;
					
				} else {
					
					$continued = false;
					$result[$i] = $num[$i] ? 0 : 1;
					
				}	
				
			}
			
			return $result;
		}
		
		/** 2의 보수 계산 */
		public static function get_2s_complement(array $num): array {
			
			$arr = array();
			
			for ($i = __MAXBIT__ - 1; $i >= 0; $i--) {
				
				$arr[$i] = ($i != 0) ? 0 : 1;
				
			}
			
			$num = complement::get_1s_complement($num);
			$result = calculation::add($num, $arr);
			
			return $result;
		}
		
	};
	
		
	class calculation {
		
		/** 덧셈 */
		public static function add(array $num1, array $num2): array {
			
			$result = array();
			$carry = 0;
			
			for ($i = 0; $i < __MAXBIT__; $i++) {
				
				if (($num1[$i] + $num2[$i] + $carry) == 0) {
					$result[$i] = 0;
					$carry = 0;
					continue;
				}
				
				if (($num1[$i] + $num2[$i] + $carry) == 1) {
					$result[$i] = 1;
					$carry = 0;
					continue;
				}
				
				if (($num1[$i] + $num2[$i] + $carry) == 2) {
					$result[$i] = 0;
					$carry = 1;
					continue;
				}
				
				if (($num1[$i] + $num2[$i] + $carry) > 2) {
					$result[$i] = 1;
					$carry = 1;
					continue;
				}
			}
			
			return $result;
		}
		
		
		/** 뺄셈 */
		public static function subtract(array $num1, array $num2): array {
			/*
			$num2_complement = complement::get_2s_complement($num2);
			$tmp_result = calculation::add($num1, $num2_complement);
			*/
		}
		
		/** 곱셈 */
		public static function multiply(array $num1, array $num2): array {
			
		}
		
		/** 나눗셈 */
		public static function divide(array $num1, array $num2): array {
			
		}
		
	};