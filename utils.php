<?php
	
	namespace calculator;

	/** 예외 처리 */
	class Exception extends \Exception {};
	class errors extends Exception {
		
		public static function exception(string $message): void {
			
			throw new Exception($message);
			
		}
		
	};
	