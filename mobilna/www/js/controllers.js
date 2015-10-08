angular.module('starter.controllers', [])

.controller('LogoutCtrl', function($scope,$rootScope) {
$scope.loggedin = true;
$scope.logout = false;


})

.controller('LoginCtrl', function($scope, $rootScope, $ionicLoading, $http, $state) {
	
	$scope.alert = false;
	$scope.upozorenje = false;
	$rootScope.userData = {};
	$scope.login  = {
    	email: "",
    	password: ""
    };

	$scope.submit = function (){
	if ($scope.login.email === "" || $scope.login.password === "") {
		$scope.alert = true;
		}
		else if ($scope.login.email !== "" || $scope.login.password !== "") {
			$scope.alert = false;
			$ionicLoading.show({
					template: '<ion-spinner></ion-spinner><br />Please wait...'
				});		
				$http({
					url: "http://localhost/knowledge/android/login.php",
					data: $scope.login,
					method: 'POST',
					headers: {
						'Content-Type': 'application/x-www-form-urlencoded'
					}
				}).success(function(data) {
					$ionicLoading.hide();
					if (data === false) {
						$scope.incorrectData = true;
					}
					else if (data !== false) {
						$rootScope.userData = data;
						$rootScope.loggedIn = true;
						$state.go("");
					}
					

				}).error(function(err) {
					$ionicLoading.hide();
					$scope.alert = true;
				});
		}
    };

$scope.submit=function(){
console.log($scope.login);

};

})


.controller('ProjektiCtrl', function($scope) {


})

.controller('DetaljiCtrl', function($scope) {
	

});