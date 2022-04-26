<?php
	namespace Calculator;
	if (!defined("__MAXBIT__")) define("__MAXBIT__", 8);
	
	class Stack {
		
		public $stack = array();
		
		public $top;
		
		public $size;
		
		
		public function __construct(int $stack_size = 0) {
			
			$this->top = -1;
			$this->size = $stack_size;
			
		}
		

		public function __destruct() {
			
			unset($this->stack, $this->top, $this->size);
			
		}
		

		/** 스택의 top 요소를 반환 */
		public function peek(): string {
			
			return ($this->stack[$this->top] == NULL) ? chr(32) : $this->stack[$this->top];
			//return $this->stack[$this->top];

		}
		

		/** 스택이 비어있으면 true, 아니면 false 반환 */
		public function is_empty(): bool {
			
			return ($this->top == -1) ? true : false;
			
		}
		

		/** 스택이 가득찼으면 true, 아니면 false 반환 */
		public function is_full(): bool {
			
			return ($this->top == $this->size - 1) ? true : false;
			
		}
		

		/** 스택에 삽입하고 top 위치 반환 */
		public function push(?string $data): int {
			
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
		
		
		/** 스택의 top 요소 제거하고 새로운 top 위치 반환 */
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
	
