<?php
	namespace calculator;
	if (!defined(__MAXBIT__)) define("__MAXBIT__", 8);
	
	
	class complement {
		

		public static function get_1s_complement(array $num): array {
			
			$result = array();
			
			for ($i = __MAXBIT__ - 1; $i >= 0; $i--) {
				
				$result[$i] = $num[$i] ? 0 : 1;
						
				
			}
			
			return $result;
		}
		
		
		public static function get_2s_complement(array $num): array {
			
			$arr = array();
			
			for ($i = __MAXBIT__ - 1; $i >= 0; $i--) {
				
				$arr[$i] = ($i != 0) ? 0 : 1;
				
			}
			
			$num = complement::get_1s_complement($num);
			$result = \calculator\calculation\addition::add($num, $arr);
			
			return $result;
		}
		
		
	};
	