(function(){
	angular.module('urlShortener')
	.factory('UrlService', UrlService);
	
	UrlService.$inject = ['$http']; 
	
	function UrlService($http) {
		var service = {
			getShortURL : getShortURL
		};
		
		return service;
		
		function getShortURL(currentURL){
			
		}
	}
})();