<?php
    namespace Calculator\Calculation;
	if (!defined("__MAXBIT__")) define("__MAXBIT__", 8);

    class Addition {
		
		/** 덧셈 */
		public static function add(array $num1, array $num2): array {
			
			$result = array();
			$carry = 0;
			
			for ($i = 0; $i <= __MAXBIT__; $i++) {
				
				if (((int)$num1[$i] + (int)$num2[$i] + (int)$carry) == 0) {
					$result[$i] = 0;
					$carry = 0;
					continue;
				}
				
				if (((int)$num1[$i] + (int)$num2[$i] + (int)$carry) == 1) {
					$result[$i] = 1;
					$carry = 0;
					continue;
				}
				
				if (((int)$num1[$i] + (int)$num2[$i] + (int)$carry) == 2) {
					$result[$i] = 0;
					$carry = 1;
					continue;
				}
				
				if (((int)$num1[$i] + (int)$num2[$i] + (int)$carry) > 2) {
					$result[$i] = 1;
					$carry = 1;
					continue;
				}
			}
			
			return $result;
			
		}

    };
	
