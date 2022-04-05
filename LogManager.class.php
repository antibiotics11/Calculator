<?php
	
	class LogManager {
		
		const _PATH_ = __DIR__.DIRECTORY_SEPARATOR;
		
		const _ELOG_ = "ErrorLogs.txt";
		
		const _PLOG_ = "ProgramLogs.txt";
		
		/** 현재시간과 인풋 메시지를 합쳐 로그 메세지를 생성한다. */
		private function set_log_message(string $input): string {
			
			date_default_timezone_set("UTC");
			$message = date("Y-m-d H:i:s", time()).chr(32).$input.chr(10);
			
			return $message;
			
		}
		
		/** 타겟 번호를 확인하여 로그 파일을 지정한다. (target == 0)이면 에러로그, (target >= 1)이면 프로그램 로그. */
		private function set_target_file(int $target): string {
			
			$target_file = self::_PATH_;
			$target_file .= ($target) ? self::_PLOG_ : self::_ELOG_;
			
			return $target_file;
			
		}
		
		/** 로그 파일을 열어서 로그 메시지를 작성한다. */
		private function write_to_file(string $target_file, string $message): int {
			
			if (is_dir(self::_PATH_) && is_writable(self::_PATH_)) {
				
				$fp = fopen($target_file, "a+");
				$bytes = fwrite($fp, $message);
				fclose($fp);
				return $bytes;
			
			} else {
				
				return -1;
				
			}
			
		}

		public function main(): void {
			
			if (for $i = 0; $i <= 2; $i++) {
			
				if (empty($_SERVER["argv"][$i])) exit(0);
				
			}
			
			$target = (int)$_SERVER["argv"][1];
			$input = (string)$_SERVER["argv"][2];
			
			$message = $this->set_log_message($input);
			
			$target_file = $this->set_target_file($target, $message);
			
			$result = $this->write_to_file($target_file, $message);
			
		}
		
	};
	
	$logm = new LogManager();
	$logm->main();
	
