<?php

class View {

	private $pageVars = array();
	private $template;
	public $model;

	public function __construct($template)
	{
		
		$this->template = APP_DIR .'views/'. $template .'.php';
	}
	
	public function loadModel($name)
	{
	
		require(APP_DIR .'models/'. strtolower($name) .'.php');

		$model = new $name;
		return $model;
	}
	public function loadModelObject($name)
	{
	
		//require(APP_DIR .'models/'. strtolower($name) .'.php');

		$model = new $name;
		return $model;
	}
	public function loadHelper($name)
	{
		require_once(APP_DIR .'helpers/'. strtolower($name) .'.php');
		$helper = new $name;
		return $helper;
	}
	
	public function loadPlugin($name)
	{
		require(APP_DIR .'plugins/'. strtolower($name) .'.php');
		$plugin = new $name;
		return $plugin;
	}
	
	public function set($var, $val)
	{
		$this->pageVars[$var] = $val;
	}

	public function render()
	{		
		extract($this->pageVars);
		ob_start();		
		require($this->template);		
		echo ob_get_clean();		
	}
	
	public function renderinvariable()
	{
		extract($this->pageVars);
		ob_start();
		require($this->template);
		return ob_get_clean();
	}
	
	public function renderinvariable1()
	{
		extract($this->pageVars);
		ob_start();
		error_reporting(0);
		require_once("application/views/partial/ordersummary.php");
		print_r($this->template); die();
		require($this->template);
		return ob_get_clean();
	}
	
	public function redirect($loc)
	{ 	
   	    global $config;	
		header('Location: '. $config['base_url'] . $loc);			
	}
    
}

?>