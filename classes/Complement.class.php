<?php
	namespace Calculator;
	if (!defined("__MAXBIT__")) define("__MAXBIT__", 8);
	
	class Complement {
		
		
		/** 1의 보수 계산해서 2진 배열로 반환 */
		public static function get_1s_complement(array $num): array {
			
			$result = array();
			
			for ($i = __MAXBIT__ - 1; $i >= 0; $i--) {
				
				$result[$i] = $num[$i] ? 0 : 1;	
				
			}
			
			return $result;
		}
		
		
		/** 2의 보수 계산해서 2진 배열로 반환 */
		public static function get_2s_complement(array $num): array {
			
			$arr = array();
			
			for ($i = __MAXBIT__ - 1; $i >= 0; $i--) {
				
				$arr[$i] = ($i != 0) ? 0 : 1;
				
			}
			
			$num = \Calculator\Complement::get_1s_complement($num);
			$result = \Calculator\Calculation\Addition::add($num, $arr);
			
			return $result;
		}
		
		
	};
	
