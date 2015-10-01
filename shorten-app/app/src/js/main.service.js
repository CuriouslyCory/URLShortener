(function(){
	angular.module('urlShortener')
	.factory('UrlService', UrlService);
	
	UrlService.$inject = ['$http']; 
	
	function UrlService($http) {
		var service = {
			getURLs: getURLs,
			getShortURL : getShortURL,
			getLongURL : getLongURL,
			apiPath: "http://" + window.location.hostname + ":8081/index"
		};
		
		return service;
		
		function getURLs(){
			return $http.get(service.apiPath)
				.then(getShortURLComplete)
				.catch(getShortURLFailed);
			
			function getShortURLComplete(response){
				return response.data;
			}
			
			function getShortURLFailed(error){
				console.log('XHR Failed for getURLs');
			}
		}
			
		function getShortURL(currentURL){
			return $http.post(service.apiPath + "", {'url': currentURL})
				.then(getShortURLComplete)
				.catch(getShortURLFailed);
			
			function getShortURLComplete(response){
				return response.data;
			}
			
			function getShortURLFailed(error){
				console.log('XHR Failed for getShortURL');
			}
		}
		
		function getLongURL(urlKey){
			return $http.get(service.apiPath + "/" + urlKey)
				.then(getLongURLComplete)
				.catch(getLongURLFailed);
			
			function getLongURLComplete(response){
				return response.data;
			}
			
			function getLongURLFailed(error){
				console.log('XHR Failed for getShortURL');
			}
		}	
	}
})();