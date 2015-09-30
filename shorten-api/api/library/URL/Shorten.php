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
	public static function create($db, $cUrl, $iContactID = 0, $cCustID = '', $cStatType = ''){
		//create a record with just the long url to reserve the record
		$sql = "INSERT INTO Shorten.URLs
				SET cLongURL = '$cUrl',
					iContactID = '$iContactID',
					cCustID = '$cCustID',
					cStatType = '$cStatType'";
		$db->Execute($sql);
		$aError = $db->errorInfo();
		
		if($aError[0] = 23000){
			$sql = "SELECT iURLID FROM Shorten.URLs WHERE cLongURL = '$cUrl' AND iContactID = '$iContactID'";
			$tmp = $db->exec_sql($sql);
			$iURLID = $tmp[0]['iURLID'];
		}else{
			//grab the insert ID, we'll be creating the hash based on this
			$iURLID = $db->lastInsertID();
		}
		
		//calculate a hash based on the ID and return
		return("http://".(ISDEV ? "dev." : "")."hwy.to/".self::getHashFromID($iURLID));
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
		$tmp = $db->exec_sql($sql);
		
		//check and see if we need to insert contact stats or not.
		if($tmp[0]['iContactID']){
			$stats = new \ContactStats($db);
			$statID = $stats->record($tmp[0]['cStatType'],
					array(
						'iContactID' => $iContactID,
						'mExtra'       => $tmp[0]['cLongURL']
					)
			);
		}
		
		return($tmp[0]['cLongURL']);
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