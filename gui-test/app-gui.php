#!/usr/bin/php
<?php

	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING); 
	ini_set("memory_limit", "-1");

	include_once "vendor/autoload.php";
	include_once "../Calculation.class.php";
	
	use Gui\Application;
	//use Gui\Components\InputText;
	use Gui\Components\Label;
	use Gui\Components\Shape;
	use Gui\Components\Button;
	use calculator\Calculation;
	use calculator\stack;
	
	const DEFAULT_FONT = "consolas";
	const DEFAULT_TITLE = "8-Bit Calculator";
	const CURRENT_VERSION = "0.1";
	const BG_COLOR = "#161b22";
	const FONT_COLOR = "#c9d1d9";
	const BTN_COLOR = "#21262d";
	
	$application = new Application([
		"title" => DEFAULT_TITLE,
		"icon" => __DIR__.DIRECTORY_SEPARATOR."icon.ico",
		"backgroundColor" => BG_COLOR,
		"width" => 359.5,
		"height" => 340,
	]);
	
	$application->on("start", function() use ($application) {

		/*
		(new Label) 
			->setFontSize(13)
			->setText(DEFAULT_TITLE.chr(32).CURRENT_VERSION)
			->setFontFamily(DEFAULT_FONT)
			->setFontColor(FONT_COLOR)
			->setTop(10)
			->setLeft(10)
		;
		
		(new Shape)
			->setBorderColor(FONT_COLOR)
			->setHeight(1)
			->setLeft(10)
			->setWidth(353)
			->setTop(42)
		;
		 */
		
		// 수식 입력 필드
		$input_field = (new Label) 
			->setFontSize(45)
			->setText(" ")
			->setFontColor(FONT_COLOR)
			->setTop(22)
			->setWidth(357.5)
			->setLeft(2)
		;
			

		// 숫자 버튼 "0"
		$btn_0 = (new Button()) 
			->setLeft(91)
			->setTop(262)
			->setValue("0")
			->setWidth(88.5)
			->setHeight(50)
		;
		
		$btn_0->on("click", function() use ($input_field) {
			
			$expression = $input_field->getText();
			$input_field->setText($expression."0");
			
		});
		
		
		// 숫자 버튼 "1"
		$btn_1 = (new Button()) 
			->setLeft(2)
			->setTop(208)
			->setValue("1")
			->setWidth(88.5)
			->setHeight(50)
		;
		
		$btn_1->on("click", function() use ($input_field) {
			
			$expression = $input_field->getText();
			$input_field->setText($expression."1");
			
		});
		
		
		// 숫자 버튼 "2"
		$btn_2 = (new Button()) 
			->setLeft(91)
			->setTop(208)
			->setValue("2")
			->setWidth(88.5)
			->setHeight(50)
		;
		
		$btn_2->on("click", function() use ($input_field) {
			
			$expression = $input_field->getText();
			$input_field->setText($expression."2");
			
		});
		

		// 숫자 버튼 "3"
		$btn_3 = (new Button()) 
			->setLeft(180.5)
			->setTop(208)
			->setValue("3")
			->setWidth(88.5)
			->setHeight(50)
		;
		
		$btn_3->on("click", function() use ($input_field) {
			
			$expression = $input_field->getText();
			$input_field->setText($expression."3");
			
		});
		

		// 숫자 버튼 "4"
		$btn_4 = (new Button()) 
			->setLeft(2)
			->setTop(154)
			->setValue("4 ")
			->setWidth(88.5)
			->setHeight(50)
		;
		
		$btn_4->on("click", function() use ($input_field) {
			
			$expression = $input_field->getText();
			$input_field->setText($expression."4");
			
		});
		

		// 숫자 버튼 "5"
		$btn_5 = (new Button()) 
			->setLeft(91)
			->setTop(154)
			->setValue("5 ")
			->setWidth(88.5)
			->setHeight(50)
		;
		
		$btn_5->on("click", function() use ($input_field) {
			
			$expression = $input_field->getText();
			$input_field->setText($expression."5");
			
		});
		

		// 숫자 버튼 "6"
		$btn_6 = (new Button()) 
			->setLeft(180.5)
			->setTop(154)
			->setValue("6 ")
			->setWidth(88.5)
			->setHeight(50)
		;
		
		$btn_6->on("click", function() use ($input_field) {
			
			$expression = $input_field->getText();
			$input_field->setText($expression."6");
			
		});
		

		// 숫자 버튼 "7"
		$btn_7 = (new Button()) 
			->setLeft(2)
			->setTop(100)
			->setValue("7 ")
			->setWidth(88.5)
			->setHeight(50)
		;
		
		$btn_7->on("click", function() use ($input_field) {
			
			$expression = $input_field->getText();
			$input_field->setText($expression."7");
			
		});
		

		// 숫자 버튼 "8"
		$btn_8 = (new Button()) 
			->setLeft(91)
			->setTop(100)
			->setValue("8 ")
			->setWidth(88.5)
			->setHeight(50)
		;
		
		$btn_8->on("click", function() use ($input_field) {
			
			$expression = $input_field->getText();
			$input_field->setText($expression."8");
			
		});
		

		// 숫자 버튼 "9"
		$btn_9 = (new Button()) 
			->setLeft(180.5)
			->setTop(100)
			->setValue("9 ")
			->setWidth(88.5)
			->setHeight(50)
		;
		
		$btn_9->on("click", function() use ($input_field) {
			
			$expression = $input_field->getText();
			$input_field->setText($expression."9");
			
		});
		

		// 연산자 버튼 "+"
		$btn_plus = (new Button()) 
			->setLeft(2)
			->setTop(262)
			->setValue("+")
			->setWidth(88.5)
			->setHeight(50)
		;
		
		$btn_plus->on("click", function() use ($input_field) {
			
			$expression = $input_field->getText();
			$input_field->setText($expression."+");
			
		});
		

		// 연산자 버튼 "-"
		$btn_minus = (new Button()) 
			->setLeft(180.5)
			->setTop(262)
			->setValue("-")
			->setWidth(88.5)
			->setHeight(50)
		;
		
		$btn_minus->on("click", function() use ($input_field) {
			
			$expression = $input_field->getText();
			if (empty(trim((string)$expression))) {
				$expression = "0";
				
			}
			$input_field->setText($expression."-");
			
		});
		

		// 연산자 버튼 "*"
		$btn_multiply = (new Button()) 
			->setLeft(269)
			->setTop(154)
			->setValue("*")
			->setWidth(88.5)
			->setHeight(50)
		;
		
		$btn_multiply->on("click", function() use ($input_field) {
			
			$expression = $input_field->getText();
			$input_field->setText($expression."*");
			
		});
		

		// 연산자 버튼 "/"
		$btn_divide = (new Button()) 
			->setLeft(269)
			->setTop(208)
			->setValue("/")
			->setWidth(88.5)
			->setHeight(50)
		;
		
		$btn_divide->on("click", function() use ($input_field) {
			
			$expression = $input_field->getText();
			$input_field->setText($expression."/");
			
		});
		

		// 연산자 버튼 "="
		$btn_equals = (new Button()) 
			->setLeft(269)
			->setTop(262)
			->setValue("=")
			->setWidth(88.5)
			->setHeight(50)
		;
		
		$btn_equals->on("click", function() use ($input_field) {
			
			$expression = $input_field->getText();
			
			if (!empty(trim((string)$expression))) {
				
				$calc = new Calculation($expression);
				$result = $calc->get_result();
				
				$input_field->setText($result);
				
			}
			
		});
		
		
		// 백스페이스 버튼
		$btn_backspace = (new Button()) 
			->setLeft(269)
			->setTop(100)
			->setValue("BS")
			->setWidth(88.5)
			->setHeight(50)
		;
		
		$btn_backspace->on("click", function() use ($input_field) {
			
			$expression = $input_field->getText();
			
			if (!empty(trim((string)$expression))) {
				
				$expression_tmp = str_split($expression);
				array_pop($expression_tmp);
				$expression = implode("", $expression_tmp);
				
				$input_field->setText($expression);
				
			}
			
		});
		
		
		// 하단 푸터
		(new Label) 
			->setFontSize(13)
			->setText("Made by ANTIBIOTICS")
			->setFontFamily("consolas")
			->setFontColor(FONT_COLOR)
			->setTop(316)
			->setLeft(4)
		;
		
		
	});

	$application->run();
	