<?php
    namespace calculator\calculation;
	if (!defined(__MAXBIT__)) define("__MAXBIT__", 8);
	

    class addition {
		
		public static function add(array $num1, array $num2): array {
			
			$result = array();
			$carry = 0;
			
			for ($i = 0; $i <= __MAXBIT__; $i++) {
				
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

    };
	