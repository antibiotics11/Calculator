<?php

	namespace calculator;
	
	if (!defined("__MAXBIT__")) define("__MAXBIT__", 64);
	
	
	class stack {
		
		public $stack = array();
		public $top;
		public $size;
		
		/** 스택 객체 생성시 크기가 입력되어야 함 */
		public function __construct(int $stack_size) {
			$this->top = -1;
			$this->size = $stack_size;
		}
		
		/** top 요소를 반환 */
		public function peek(): string {
			
			return ($this->stack[$this->top] == NULL) ? chr(32) : $this->stack[$this->top];
			
		}
		
		/** 스택이 비어있는지 확인 */
		public function is_empty(): bool {
			
			return ($this->top == -1) ? true : false;
			
		}
		
		/** 스택이 가득찼는지 확인 */
		public function is_full(): bool {
			
			return ($this->top == $this->size - 1) ? true : false;
			
		}
		
		/** 스택에 저장하고 top 위치를 반환 */
		public function push(string $data): int {
			
			if ($this->is_empty()) {
				
				$this->stack[0] = $data;
				$this->top = 0;
				
			} else if ($this->is_full()) {
				
				return $this->top;
				
			} else {
				
				$this->stack[$this->top + 1] = $data;
				$this->top++;
				
			}
			
			return $this->top;
		}
		
		/** 스택에서 제거하고 top 위치를 반환 */
		public function pop(): int {
			
			if ($this->is_empty()) {
				
				return -1;
				
			} else {
				
				unset($this->stack[$this->top]);
				$this->top--;
				
			}
			
			return $this->top;
		}
		
	};
	
	class expression {
		
		/** 사용 가능한 문자 목록 */
		private $characters_allowed = array( 
			"space" => " ", 
			"opening_bracket" => "(", 
			"closing_bracket" => ")" 
		);
		
		/** 사용 가능한 연산자 목록 */
		private $operators_allowed = array( 
			"plus" => "+", 
			"minus" => "-", 
			"multiply" => "*", 
			"divide" => "/" 
		);
		
		/** 연산자 우선순위 */
		private $precedence = array( 
			"plus" => 1, 
			"minus" => 1, 
			"multiply" => 2, 
			"divide" => 2 
		);
		
		/** 후위표기식 */
		private $postfix = array();
		
		public function __construct(string $expression) {
			
			$expression = str_split($expression, 1);
			if (!$this->convert_postfix($expression)) {
				errors::exception("Expression could not be converted to postfix");
			}
			
		}
		
		/** 중위표기식을 후위표기식으로 변환 */
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
					
				// 괄호 "("인 경우
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
				
				// 공백 " "인 경우
				} else if ($chr == chr(32)) {
					
					continue;
				
				// 전부 아니면
				} else {
					
					errors::exception("");
					
				}
				
			}
			
			while (!$operator->is_empty()) {
					
				$result->push($operator->peek());
				$operator->pop();
					
			}
			
			$this->postfix = $result->stack;
			
			return true;
		}
		
		/** 후위표기식을 반환 */
		public function get_postfix(): array {
			return $this->postfix;
		}
		
		
	};
	