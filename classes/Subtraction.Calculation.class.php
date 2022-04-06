<?php
	namespace Calculator\Calculation;
	if (!defined(__MAXBIT__)) define("__MAXBIT__", 8);

	class Subtraction {


		/** 1의 보수 뺄셈 */
		public static function subtract1(array $num1, array $num2): array {
		
			$num2_complement = \Calculator\Complement::get_1s_complement($num2);
	
			$addition_result = \Calculator\Calculation\Addition::add($num1, $num2_complement);
			$result = array();

			if ((int)$addition_result[__MAXBIT__] == 1) {

				$one = \Calculator\Binary::dec_to_bin(1);
				$result = \Calculator\Calculation\Addition::add($addition_result, $one);
				$result[__MAXBIT__] = 0;
		
			} else {
				
				$result = \Calculator\Complement::get_1s_complement($addition_result);			
				$result[__MAXBIT__] = 1;
				
			}

			return $result;

		}


		/** 2의 보수 뺄셈 */
		public static function subtract2(array $num1, array $num2): array {

			$num2_complement = \Calculator\Complement::get_2s_complement($num2);

			$addition_result = \Calculator\Calculation\Addition::add($num1, $num2_complement);
			$result = array();

			if ((int)$addition_result[__MAXBIT__] == 1) {

				$result = $addition_result;
				$result[__MAXBIT__] = 0;    

			} else {

				$result = \Calculator\Complement::get_2s_complement($addition_result);
				$result[__MAXBIT__] = 1;

			}

			return $result;

		}

    };
