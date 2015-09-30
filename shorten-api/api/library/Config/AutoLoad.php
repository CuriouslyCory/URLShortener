<?php
//Load the Zend Classes
require_once "Zend/Loader/Autoloader.php";
$oLoader = Zend_Loader_Autoloader::getInstance();

// optional argument if you want the auto-loader to load ALL namespaces
$oLoader->setFallbackAutoloader(true);
$oLoader->pushAutoloader("_loader");
//this used for autoloading our internal classes
//spl_autoload_register('_loader');

function _loader($class){
	//include paths are set in index.php
	$aIncludePaths = explode(":",get_include_path());
	
	$parts = explode('\\', $class);
	foreach($aIncludePaths as $path){
		if(file_exists($path.DIRECTORY_SEPARATOR.'class'.$class.'.php')){
			include_once('class'.$class.'.php');
			return;
		}
		//try ucwords on the class for proper caps
		if(file_exists($path.DIRECTORY_SEPARATOR.'class'.ucwords($class).'.php')){
			include_once('class'.ucwords($class).'.php');
			return;
		}
		if(file_exists($path."/".implode("/",$parts) . '.php')){
			include_once($path."/".implode("/",$parts) . '.php');
			return;
		}
	}
}