<?php 
namespace URL;

class Shorten {
	/**
	 * 5 digit codes start at 14776336
	 */
	
	/**
	 * Character classes defined in RFC-3986
	 */
	static $CharMap = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	
	/**
     * Create a short url
     *
     * @param  string $url
     * @return ShortURL
     */
	public static function create($db, $cUrl){
		//create a record with just the long url to reserve the record
		$cHash = hash('sha256', $cUrl);
		$sql = "INSERT INTO Shorten.URLs
				SET mLongURL = '$cUrl',
				cHash = '$cHash'";
		$oStmt = $db->query($sql);
		$aError = $db->errorInfo();
		
		if($aError && count($aError) > 0){
			if($aError[0] = 23000){
				$sql = "SELECT iURLID FROM Shorten.URLs
						WHERE cHash = '$cHash'";
				$oStmt = $this->query($sql);
				$aResult = $oStmt->fetchAll();
			
				$iURLID = $aResult[0]['iURLID'];
			}
		}else{
			$aResult = $oStmt->fetchAll();
			$iURLID = $db->lastInsertID();
		}
		
		$aURL = array('shortURL'=> self::getHashFromID($iURLID), 'longURL' => $cURL);
		//calculate a hash based on the ID and return
		return($aURL);
	}
	
	/**
	 * Fetch a long url from a short one
	 *
	 * @param  string $url
	 * @return ShortURL
	 */
	public static function get($db, $url){
		//strip hash from url
		$urlParts = parse_url($url);
		$pathParts = explode("/",  $urlParts['path']);
		
		$path = array_pop($pathParts);
		
		//convert the hash back into the pk
		$urlID = self::getIDFromHash($path);
		
		$sql = "SELECT * FROM Shorten.URLs WHERE iURLID = '$urlID'";
		$oStmt = $db->query($sql);
		$aError = $db->errorInfo();
		
		if($aError && count($aError) > 0){
			print_r($aError);
			return false;
		}else{
			$aResult = $oStmt->fetchAll();
			return($aResult[0]);
		}
	}
	
	public static function getList($db){
		$aResults = array();
		
		$sql = "SELECT * FROM Shorten.URLs ORDER BY iURLID DESC LIMIT 100";
		$oStmt = $db->query($sql);
		
		if(!$oStmt){
			$aError = $db->errorInfo();
			print_r($aError);
			return false;
		}else{
			$aResult = $oStmt->fetchAll();
			if($aResult && count($aResult) > 0){
				foreach($aResult as $aRow){
					$aResults[] = array(
						'longURL' => $aRow['cLongURL'],
						'shortURL' => $this->getHashID($aRow['iURLID'])
					);
				}
			}
		}
		return($aResults);
	}
	
	public static function getHashFromID($id){
		$base = strlen(self::$CharMap);
		
		if($id == 0){
			return self::$CharMap[0];
		}
		
		while($id > 0){
			$hash .= self::$CharMap[$id % $base];
			$id = floor($id / $base);
		}
		
		$hash = strrev($hash);
		
		return $hash;
	}
	
	public static function getIDFromHash($hash){
		$aHash = str_split($hash);
		$id = 0;
		$base = strlen(self::$CharMap);
		$ChrArray = str_split(self::$CharMap);
		
		foreach($aHash as $letter){
			$id = ($id * $base) + array_search($letter, $ChrArray);
		}
		
		return $id;
	}
}