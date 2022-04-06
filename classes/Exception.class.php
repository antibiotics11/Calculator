<?php
	namespace Calculator;
	
	class Exception extends \Exception {};
	class Errors extends Exception {
		
		public static function exception(string $message): void {
			
			throw new Exception($message);
			
		}
		
	};
	