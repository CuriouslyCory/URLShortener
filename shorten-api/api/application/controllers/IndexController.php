<?php

class IndexController extends Zend_Rest_Controller {
	
	private $db;
	
    public function init() {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->db = Zend_Registry::get('db');
    }
    
    //Get url list
    public function indexAction(){
    	$jList = URL\Storage::getList($this->db);
    	$this->getResponse()->setBody($jList);
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
    	//check session to see if the url has already been minified
    	if($oSession->URLs[$this->_request->getParam('url')]){
    		$json[] = array(
    			'shortURL' => $oSession->URLs[$this->_request->getParam('url')],
    			'longURL' => $this->_request->getParam('url')
    		);
    	}
    	$json[] = array('shortURL'=> 'http://hua.me/short', 'longURL'=>'http://example.com/some/long/url');
    	$this->getResponse()->setHttpResponseCode(201);
    	$this->getResponse()->setBody(Zend_Json::Encode($json));
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

