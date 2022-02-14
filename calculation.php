<?php
	namespace calculator;
	
	if (!defined("__MAXBITS__")) define("__MAXBITS__", 8);
	
	
	class binary {
		
		/** 10진수가 최댓값을 넘는지 확인 */
		public static function dec_exceed(int $num): bool {

			$exceed = ($num <= 255 && count(binary::dec_to_bin($num)) <= __MAXBITS__);
			return $exceed ? false : true;
			
		} 
		
		
		/** 2진 배열이 최댓값을 넘는지 확인 */
		public static function bin_exceed(array $num): bool {
			
			$exceed = (count($num) <= __MAXBITS__ && binary::bin_to_dec($num) <= 255);
			return $exceed ? false : true;
			
			
		}
		
		
		/** 10진수를 2진 배열로 반환 */
		public static function dec_to_bin(int $num): array {
			
			$result = array();
			for ($i = __MAXBITS__ - 1; $i >= 0; $i--) {
				$result[$i] = $num >> $i & 1;
			}
			
			return $result;
		}
		
		
		/** 2진 배열을 10진수로 반환 */
		public static function bin_to_dec(array $num): int {
			
			$position = __MAXBITS__ - 1;
			$result = 0;
			for ($i = __MAXBITS__ - 1; $i >= 0; $i--) {
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
			
			for ($i = 0; $i < __MAXBITS__ - 1; $i++) {
				
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
			
			
			
		}
		
	};
	
	
	class calculation {
		
		/** 덧셈 */
		public static function add(array $num1, array $num2): array {
			
			$result = array();
			$carry = 0;
			
			for ($i = 0; $i < __MAXBITS__; $i++) {
				
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
		
		
		/** 곱셈 */
		public static function multiply(array $num1, array $num2): array {
			
		}
		
		
		/** 나눗셈 */
		public static function divide(array $num1, array $num2): array {
			
		}
		
	};