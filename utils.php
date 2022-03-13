<?php
	
	namespace calculator;

	/** 예외 처리 */
	class Exception extends \Exception {};
	class errors extends Exception {
		
		public static function exception(string $message): void {
			
			throw new Exception($message);
			
		}
		
	};
	
	
	/** 실행시간 측정 */
	class time {
		
		private $start;
		
		public function __construct() {
			$this->start = microtime(true);
		} 
		
		public function measure(): float {
			$current = microtime(true);
			$running_time = round(($current - (int)$this->start), 2);
			return $running_time;
		}
		
		public function __destruct() {
			unset($this->start);
		}
		
	};
	