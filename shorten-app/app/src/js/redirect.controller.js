(function(){
	//register the navigation controller
	angular.module('urlShortener')
	.controller("RedirectController", RedirectController);
	
	RedirectController.$inject = ['UrlService','$routeParams','$window'];
	
	function RedirectController( UrlService, $routeParams, $window ) {
	    //bindings
	    var vm = this;
	    
	    //variables
	    vm.urlKey = $routeParams.urlKey;
	    vm.urlCache = [];
	    	
	    //functions
	    vm.getLongURL = getLongURL;
	    
	    activate();
	    
	    function activate() {
	    	console.log(vm.urlKey);
	    	if(typeof(vm.urlCache[vm.urlKey]) == 'undefined'){
	    		return getLongURL(vm.urlKey).then(function(){
		    		//console.log("Activated Nav");
		    	});
	    	}else{
	    		return vm.urlCache[vm.urlKey];
	    	}
	    }
	    
	    function getLongURL(urlKey){
	    	return UrlService.getLongURL(urlKey).then(function(data){
	    		if(typeof(data[0]) != 'undefined'){
	    			$window.location.href = data[0].longURL;
	    		}else{
	    			$window.location.href = "/index";
	    		}
	    	});
	    }    
	}
})();