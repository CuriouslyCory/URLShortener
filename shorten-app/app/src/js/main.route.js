(function(){
	angular.module('urlShortener')
	.config(MainRoute);
	
	MainRoute.$inject = ['$routeProvider', '$locationProvider'];
	
	function MainRoute($routeProvider, $locationProvider) {
		$routeProvider
			.when('/index', {
				controller: 'MainController',
				templateUrl: '/partials/main-view.html',
				controllerAs: 'vm'
			})
			.when('/r/:urlKey', {
				controller: 'RedirectController',
				templateUrl: '/partials/blank.html',
				controllerAs: 'vm'
			})
			.otherwise({
				redirectTo: '/index'
			});
		
		$locationProvider.html5Mode(true);
		
	}
})();
