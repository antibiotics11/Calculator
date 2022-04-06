<?php
	namespace Calculator;
	if (!defined(__MAXBIT__)) define("__MAXBIT__", 8);
	
	class Binary {
		
		
		/** 10진수가 최댓값을 넘는지 확인 */
		public static function dec_exceed(int $num): bool {
			
			return (count(\Calculator\Binary::dec_to_bin($num)) <= __MAXBIT__) ? false : true;
			
		}
		
		
		/** 2진 배열이 최댓값을 넘는지 확인 */
		public static function bin_exceed(array $num): bool {
			
			return (count($num) <= __MAXBIT__) ? false : true;
			
		}
		
		
		/** 10진수를 2진 배열로 변환 */
		public static function dec_to_bin(int $num): array {
			
			$result = array();
			
			for ($i = __MAXBIT__ - 1; $i >= 0; $i--) {
				
				$result[$i] = $num >> $i & 1;
				
			}
			
			return $result; 
		}
		
		
		/** 2진 배열을 10진수로 변환 */
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
	