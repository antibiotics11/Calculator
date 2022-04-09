<?php

	namespace Calculator;

	class LogicGate {


		public static function AND(int $a, int $b): int {

			return ($a && $b) ? 1 : 0;

		}


		public static function OR(int $a, int $b): int {

			return ($a || $b) ? 1 : 0;

		}


		public static function NOT(int $a): int {

			return !$a;

		}


		public static function BUFFER(int $a): int {

			return $a;

		}


		public static function NAND(int $a, int $b): int {

			return ($a && $b) ? 0 : 1;

		}


		public static function NOR(int $a, int $b): int {

			return (!$a && !$b) ? 1 : 0; 

		}


		public static function XNOR(int $a, int $b): int {

			return ($a == $b) ? 1 : 0;

		}


		public static function XOR(int $a, int $b): int {

			return ($a == $b) ? 0 : 1;

		}
	
	};

