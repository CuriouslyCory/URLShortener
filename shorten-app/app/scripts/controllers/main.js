'use strict';

/**
 * @ngdoc function
 * @name shortenApiApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the shortenApiApp
 */
angular.module('shortenApiApp')
  .controller('MainCtrl', function ($scope) {
    $scope.awesomeThings = [
      'HTML5 Boilerplate',
      'AngularJS',
      'Karma'
    ];
  });
