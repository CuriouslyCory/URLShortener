'use strict';

/**
 * @ngdoc function
 * @name shortenApiApp.controller:AboutCtrl
 * @description
 * # AboutCtrl
 * Controller of the shortenApiApp
 */
angular.module('shortenApiApp')
  .controller('AboutCtrl', function ($scope) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
  });
