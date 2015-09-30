<?php
namespace URL;

class Storage {
	
	public static function getList($db){
		$sql = "";
		return \Zend_Json::encode(array(array('shortURL' => 1, 'longURL' => 2), array('shortURL' => 3, 'longURL' => 4)));
	}
}