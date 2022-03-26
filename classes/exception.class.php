<?php
	namespace calculator;
	
	class Exception extends \Exception {};
	class errors extends Exception {
		
		public static function exception(string $message): void {
			
			throw new Exception($message);
			
		}
		
	};
	