<?php
    namespace Calculator\Calculation;
	if (!defined(__MAXBIT__)) define("__MAXBIT__", 8);

    class Division {
	
		/** 나눗셈 */
        public static function divide(array $num1, array $num2): array {
			
			$partial_remainder = $num1;
			$quotient = array();
			
			$result = \Calculator\Binary::dec_to_bin(0);
			
			return $result;

        }

    };
	