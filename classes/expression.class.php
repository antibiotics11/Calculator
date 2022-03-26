<?php
	namespace calculator;
	
	
	class expression {
		
		
		/**
		 * 사용 가능한 문자 목록
		 */
		private $characters_allowed = array( 
		
			"space" => " ", 
            //"comma" => ",",
			"opening_bracket" => "(", 
			"closing_bracket" => ")" 
			
		);
		
		
		/** 
		 * 사용 가능한 연산자 목록
		 */
		private $operators_allowed = array( 
		
			"plus" => "+", 
			"minus" => "-", 
			"multiply" => "*", 
			"divide" => "/" 
			
		);
		
		
		/** 
         * 우선순위가 높은 연산자일수록 큰 숫자 부여
         */
		private $precedence = array( 
		
			"plus" => 1, 
			"minus" => 1, 
			"multiply" => 2, 
			"divide" => 2 
			
		);
		

		private $postfix = array();

		
		/**
		 * 
		 */
		public function __construct(string $expression) {
			
			$expression = str_split($expression, 1);
			if (!$this->convert_postfix($expression)) {
				errors::exception("Expression could not be converted to postfix");
			}
			
		}
		
		
		/** 
		 * 중위표기식 배열을 후위표기식 배열로 변환하는데 성공했으면 true, 아니면 false 반환
		 * 변환된 후위표기식은 $this->postfix에 저장
		 */
		public function convert_postfix(array $expression): bool {
			
			$result = new stack(count($expression));
			$operator = new stack(count($expression));
			
			for ($i = 0; $i < count($expression); $i++) {
				
				$chr = $expression[$i];
				
				// 피연산자인 경우
				if (is_numeric($chr)) {
					
					$num = $chr;
					$k = 0;
					for ($j = $i + 1; $j < count($expression); $j++) {
						if (is_numeric($expression[$j])) {
							$num .= $expression[$j];
							$k++;
						} else {
							break;
						}
					}
					
					$result->push($num);
					$i += $k;
					
				// 연산자인 경우
				} else if (in_array($chr, $this->operators_allowed)) {
					
					while (!$operator->is_empty() && 
						$this->precedence[array_search($chr, $this->operators_allowed)] <=
						$this->precedence[array_search($operator->peek(), $this->operators_allowed)]
					) {
					
						$result->push($operator->peek());
						$operator->pop();
					
					}
					
					$operator->push($chr);
					
				// 괄호 "("인 경우 스택에 삽입
				} else if ($chr == chr(40)) {
					
					$operator->push($chr);
					
				// 괄호 ")"인 경우	
				} else if ($chr == chr(41)) {
					
					while (!$operator->is_empty() && $operator->peek() != chr(40)) {
						$result->push($operator->peek());
						$operator->pop();
					}
					
					if ($operator->peek() == chr(40)) {
						$operator->pop();
					}
				
				// 공백 " "인 경우 무시
				} else if ($chr == chr(32)) {
					
					continue;
				
				// 전부 아니면 오류 발생
				} else {
					
					errors::exception("Unknown operator or character");
					
				}
				
			}
			
			while (!$operator->is_empty()) {
					
				$result->push($operator->peek());
				$operator->pop();
					
			}
			
			$this->postfix = $result->stack;
			
			return true;
		}
		
		
		/**
		 * 후위표기식 배열을 반환
		 */
		public function get_postfix(): array {
			
			return $this->postfix;
			
		}
		
		
	};
	