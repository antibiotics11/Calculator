<?php
    namespace calculator\calculation;
	if (!defined(__MAXBIT__)) define("__MAXBIT__", 8);
	

    class subtraction {

        public static function subtract(array $num1, array $num2): array {
			
			$num2_complement = \calculator\complement::get_1s_complement($num2);
			
			$addition_result = \calculator\calculation\addition::add($num1, $num2_complement);
			
			if ($addition_result[__MAXBIT__] == 1) {
				
				$one = \calculator\binary::dec_to_bin(1);
				$result = \calculator\calculation\addition::add($addition_result, $one);
				
				$result[__MAXBIT__] = 0;
				
			} else {
				
				$result = \calculator\complement::get_1s_complement($addition_result);
				
				$result[__MAXBIT__] = 1;
				
			}
			
			return $result;

        }

    };