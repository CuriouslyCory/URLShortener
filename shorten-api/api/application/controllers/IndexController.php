<?php

class IndexController extends Zend_Rest_Controller {
	
	private $db;
	
    public function init() {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->db = Zend_Registry::get('db');
    }
    
    //Get list of shortened urls from database
    public function indexAction(){
    	$aList = URL\Shorten::getList($this->db);
    	$this->_helper->json($aList);
    }

    //This has to be here per the abstract method this class extends
    public function headAction(){
    	echo "HeadAction";
    	exit();
    }
    
    //Get specific item
    public function getAction() {
		//Not in use
    	echo "GetAction";
    	exit();
    }
    
    //Create new shortened url
    public function postAction() {
    	$cURL = $this->getRawParam('url');
    	$aList = URL\Shorten::create($this->db, $cURL);
    	//201 code is standard for "created"
    	$this->getResponse()->setHttpResponseCode(201);
    	$this->_helper->json($aList);
    }
    
    //This is where I'd put url update logic.. IF I HAD ANY!!!
    public function putAction(){
    	echo "put action";
    	exit();
    }
    
    //remove url from session
    public function deleteAction() {
    	//TODO: Add delete function
    	echo "DeleteAction";
    	exit();
    }
    
    //Angular's default post uses json encoded parameters instead of a normal request object. 
    //decode the paramters and return
    private function getRawParams() {
    	$cRawBody = $this->_request->getRawBody();
    	$aData = Zend_Json::decode($cRawBody);
    	return $aData;
    }
    
    //decode and return an individual parameter
    private function getRawParam($key) {
    	$cRawBody = $this->_request->getRawBody();
    	$aData = Zend_Json::decode($cRawBody);
    	return $aData[$key];
    }
}

