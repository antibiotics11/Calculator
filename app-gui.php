#!/usr/bin/php
<?php

    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING); 

    include_once __DIR__.DIRECTORY_SEPARATOR."vendor/autoload.php";
	include_once "calculation.class.php";
	
	use Gui\Application;
	use Gui\Components\InputText;
	use Gui\Components\Label;
	use Gui\Components\Button;
	use calculator\calculation;
	
	$application = new Application([
		"title" => "8-bit calculator",
		"width" => 370,
		"height" => 300,
	]);
	
	$application->on("start", function() use ($application) {
		
		(new Label) 
			->setFontSize(17)
			->setText("8-bit calculator")
			->setTop(10)
			->setLeft(10)
		;
		
		$input = (new InputText())
			->setLeft(10)
			->setValue("")
			->setTop(50)
			->setWidth(350)
		;
		
		$btn = (new Button()) 
			->setLeft(10)
			->setTop(100)
			->setValue("=")
			->setWidth(50)
		;
		
		$calculate = function() use ($application, $btn, $input) {
			
			$expression = $input->getValue();
			
			if (!empty($expression)) {
				
				$calculation = new calculation($expression);
				$result = $calculation->get_result();
				
			}
			
			$input->setValue($result);
			
		};
		
		$btn->on("click", $calculate);
		
	});

	$application->run();
	