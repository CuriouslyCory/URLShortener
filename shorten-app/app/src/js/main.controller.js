(function(){
	//register the navigation controller
	angular.module('urlShortener')
	.controller("MainController", MainController);
	
	MainController.$inject = ['UrlService'];
	
	function MainController( UrlService ) {
	    //bindings
	    var vm = this;
	    
	    //variables
	    vm.urls = [];
	    vm.currentURL = '';
	    	
	    //functions
	    vm.getShortURL = getShortURL;
	    vm.getURLs = getURLs;
	    
	    activate();
	    
	    function activate() {
	    	return getURLs().then(function(){
	    		//console.log("Activated Nav");
	    	});
	    }
	    
	    function getURLs(){
	    	return UrlService.getURLs().then(function(data){
//	    		console.log(data);
	    		vm.urls = data;
	    		return vm.urls;
	    	});
	    }
	    
	    function getShortURL(){
	    	UrlService.getShortURL(vm.currentURL).then(function(data){
	    		var newURL = {longURL:data.longURL, shortURL: data.shortURL};
		    	vm.urls.push(newURL);
	    	});
	    }	    
	}
})();