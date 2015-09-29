(function(){
	//register the navigation controller
	angular.module('urlShortener')
	.controller("MainController", MainController);
	
	MainController.$inject = ['UrlService'];
	
	function MainController( UrlService ) {
	    //bindings
	    var vm = this;
	    
	    //variables
	    vm.urls = [
           {longURL: 'http://www.google.com', shortURL: 'http://hua.me/blarg'},
           {longURL: 'http://www.yahoo.com', shortURL: 'http://hua.me/blurg'},
           {longURL: 'http://www.bing.com', shortURL: 'http://hua.me/blerg'}
        ];
	    vm.currentURL = '';
	    	
	    //functions
	    vm.getShortURL = getShortURL;
	    
	    activate();
	    
	    function activate() {

	    }
	    
	    function getShortURL(){
	    	var newURL = {longURL:vm.currentURL, shortURL: 'http://hua.me/test'};
	    	vm.urls.push(newURL);
	    }	    
	}
})();