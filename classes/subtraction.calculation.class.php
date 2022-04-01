<?php
    namespace calculator\calculation;
    if (!defined(__MAXBIT__)) define("__MAXBIT__", 8);
	

    class subtraction {


	/** 1의 보수 뺄셈 */
        public static function subtract1(array $num1, array $num2): array {
			
	    $num2_complement = \calculator\complement::get_1s_complement($num2);
			
	    $addition_result = \calculator\calculation\addition::add($num1, $num2_complement);
	    $result = array();

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


	/** 2의 보수 뺄셈 */
	public static function subtract2(array $num1, array $num2): array {

	    $num2_complement = \calculator\complement::get_2s_complement($num2);

	    $addition_result = \calculator\calculation\addition::add($num1, $num2_complement);
	    $result = array();

            if ($addition_result[__MAXBIT__] == 1) {

		$result = $addition_result;
		$result[__MAXBIT__] = 0;    

            } else {

		$result = \calculator\complement::get_2s_complement($addition_result);
		$result[__MAXBIT__] = 1;

	    }

            return $result;

	}


    };
