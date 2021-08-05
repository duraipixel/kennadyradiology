<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/*
  header('X-Frame-Options: SAMEORIGIN'); 
  header("X-XSS-Protection: 1; mode=block");
  // How to send the response header with PHP
  header("X-Content-Type-Options: nosniff");
   // How to send the response header with PHP
  header("Strict-Transport-Security: max-age=31536000"); */
 
/*
 * PIP v0.5.3
 */

ini_set('session.name', 'FRNTPHPSESSID');
//Start the Session
session_start(); 

// Defines
define('ROOT_DIR', realpath(dirname(__FILE__)) .'/');
define('APP_DIR', ROOT_DIR .'application/');


// Includes
require(APP_DIR .'config/config.php');
require(ROOT_DIR .'system/model.php');
require(ROOT_DIR .'system/view.php');
require(ROOT_DIR .'system/controller.php');
require(ROOT_DIR .'system/pip.php');


// Define base URL
global $config;
define('BASE_URL', $config['base_url']);
define('TRI_BASE_URL', $config['tri_base_url']);
define('IMG_URL', $config['img_base_url']);
define('DEFAULT_IMG', $config['imgdefault']);
define('DEFAULT_SPLIMG', $config['imgspldefault']);
define('HOMENEWSIMG', $config['imgnewsdefault']);

define('BASE_URL', $config['base_url']);

if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start('ob_gzhandler'); else ob_start(); 


pip();
?>
