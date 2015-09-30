<?php

class IndexController extends Zend_Rest_Controller {
	
	private $db;
	
    public function init() {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->db = Zend_Registry::get('db');
    }
    
    //Get url list
    public function indexAction(){
    	$aList = URL\Shorten::getList($this->db);
    	$this->getResponse()->setBody(Zend_Json::encode($aList));
    	$this->getResponse()->setHttpResponseCode(200);
    }

    //This has to be here per the abstract method this class extends
    public function headAction(){
    	
    }
    
    //Get specific item
    public function getAction() {
		//Not in use
    }
    
    //Create new shortened url
    public function postAction() {
    	$json = array();
    	$cURL = $this->_request->getParam('url');
    	$aList = URL\Shorten::create($this->db, $cURL);
    	
    	$this->getResponse()->setHttpResponseCode(201);
    	$this->getResponse()->setBody(Zend_Json::encode($json));
    }
    
    //This is where I'd put url update logic.. IF I HAD ANY!!!
    public function putAction(){
    	
    }
    
    //remove url from session
    public function deleteAction() {
    	$json = array();
    	$json['succes'] = true;
    	echo Zend::Json_Encode($json);
    }
}

