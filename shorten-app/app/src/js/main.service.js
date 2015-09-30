(function(){
	angular.module('urlShortener')
	.factory('UrlService', UrlService);
	
	UrlService.$inject = ['$http']; 
	
	function UrlService($http) {
		var service = {
			getURLs: getURLs,
			getShortURL : getShortURL,
			apiPath: "http://" + window.location.hostname + ":8081"
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
			return $http.post(apiPath, {'url': currentURL})
				.then(getShortURLComplete)
				.catch(getShortURLFailed);
			
			function getShortURLComplete(response){
				return response;
			}
			
			function getShortURLFailed(error){
				console.log('XHR Failed for getShortURL');
			}
		}	
	}
})();