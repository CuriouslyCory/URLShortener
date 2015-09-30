<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
	
	//start the zend session manager
	protected function _initSession(){
		Zend_Session::start();
	}
	
	//define the default controller as a rest controller
	protected function _initRestRoute()	{
		$this->bootstrap('frontController');
		$oFrontController = Zend_Controller_Front::getInstance();
		$oRestRoute = new Zend_Rest_Route($oFrontController);
		$oFrontController->getRouter()->addRoute('default', $oRestRoute);
	}
	
	//set up the logger
	protected function _initLogger(){
		$oWriter = new Zend_Log_Writer_Stream('php://output');
		$oLogger = new Zend_Log($oWriter);
		
		Zend_Registry::set('logger', $oLogger);
	}
	
	protected function _initDB(){
		$db = new PDO('mysql:host=shorten-db;', 'root', 'my-secret-pw');
		Zend_Registry::set('db', $db);
	}

}

