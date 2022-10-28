<?php
class Controller {

	public function repository($name)
	{
		require_once(APP_DIR .'models/repository/'. strtolower($name) .'.php');
		$name = explode('_', $name );
		$name = array_map('ucfirst', $name);
		$class_name = implode('', $name);
		$model = new $class_name;
		return $model;
	}
	
	public function loadModel($name)
	{
		require_once(APP_DIR .'models/'. strtolower($name) .'.php');

		$model = new $name;
		return $model;
	}
	
	public function loadView($name)
	{	
		$view = new View($name);
		return $view;
	}
	
	public function loadPlugin($name)
	{		
		require_once(APP_DIR .'plugins/'. strtolower($name) .'.php');
		$plugin = new $name;
		return $plugin;
	}
	
	public function loadHelper($name)
	{
		require_once(APP_DIR .'helpers/'. strtolower($name) .'.php');
		$helper = new $name;
		return $helper;
	}
	
	public function redirect($loc)
	{ 	
   	    global $config;	
		header('Location: '. $config['base_url'] . $loc);			
	}
	public function redirect_301($loc)
	{ 	
   	    global $config;
		header("HTTP/1.1 301 Moved Permanently"); 		
		header('Location: '. $config['base_url'] . $loc);			
	}
	public function redirectURL($loc)
	{ 	
   	    global $config;
		header("HTTP/1.1 301 Moved Permanently"); 		
		header('Location: ' . $loc);			
	}

	public function view($file, $data = []) {
		$data[] = $_POST;
		
		extract($data);
		ob_start();		
		$view_path = APP_DIR .'views/'. $file .'.php';
		require($view_path);		
		echo ob_get_clean();	
	}

	public function viewFile($file, $data = []) {
		$data[] = $_POST;
		
		extract($data);
		ob_start();		
		$view_path = APP_DIR .'views/'. $file .'.php';
		require($view_path);		
		echo ob_get_clean();	
	}
	
	
}
?>