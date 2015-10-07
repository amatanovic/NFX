angular.module('starter.controllers', [])

.controller('LogoutCtrl', function($scope,$rootScope) {
$rootScope.loggedin = false;


})

.controller('LoginCtrl', function($scope) {
	$scope.login={
	email: "sdbgjdsb",
	password: "ldlgjsdg"
};

$scope.submit=function(){
console.log($scope.login);

};

})


.controller('ProjektiCtrl', function($scope) {


})

.controller('DetaljiCtrl', function($scope) {
	

});