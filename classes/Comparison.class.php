<?php
	namespace Calculator;
	if (!defined(__MAXBIT__)) define("__MAXBIT__", 8);

	class Comparison {
	
		/** 두 이진 배열 중 더 큰수를 확인 
		 * return(1): num1이 더 큼, return(2): num2가 더 큼, return(0) 두 수가 같음
		 */
		public static function compare_bin(array $num1, array $num2): int {

			$tmp = (!isset($num1[__MAXBIT__]) || !isset($num2[__MAXBIT__])) ? __MAXBIT__-1 : __MAXBIT__;

			for ($i = $tmp; $i >= 0; $i = (new \Calculator\Calculation($i."-1"))->get_result()) {

				if (\Calculator\LogicGate::XOR($num1[$i], $num2[$i])) { 

					return (\Calculator\LogicGate::AND($num1[$i], 1)) ? 1 : 2;

				}

				if (\Calculator\LogicGate::NOR($i, 0)) return 0;

			}

		}

	
	};
