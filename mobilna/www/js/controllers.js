angular.module('starter.controllers', [])

.controller('LogoutCtrl', function($scope,$rootScope,$state,$timeout) {
$rootScope.$on('$ionicView.beforeEnter', function () {
var stateName = $state.current.name;
if (stateName === 'tab.login') {
$rootScope.hideTabs = true;
} else {
$rootScope.hideTabs = false;
}
});
$scope.odjava = function(){
$state.go("tab.login");
}

})

.controller('OdjavaCtrl', function($scope,$rootScope,$state, $ionicLoading) {


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
					url: "http://localhost/nfx/android/login.php",
					data: $scope.login,
					method: 'POST',
					headers: {
						'Content-Type': 'application/x-www-form-urlencoded'
					}
				}).success(function(data) {
					$ionicLoading.hide();
					if (data === false) {
						$scope.alert = true;
					}
					else if (data !== false) {
						$rootScope.userData = data;
						$state.go("tab.projekti");
					}
					

				}).error(function(err) {
					$ionicLoading.hide();
					$scope.upozorenje = true;
				});
		}
    };

})


.controller('ProjektiCtrl', function($scope, $rootScope, $ionicLoading, $http) {
$rootScope.transakcijeZbroj= [];
$scope.uplate = function (item) {
$scope.data = {
	sifra: item.sifra
};

$ionicLoading.show({
					template: '<ion-spinner></ion-spinner><br />Please wait...'
				});		
				$http({
					url: "http://localhost/nfx/android/transakcije.php",
					data: $scope.data,
					method: 'POST',
					headers: {
						'Content-Type': 'application/x-www-form-urlencoded'
					}
				}).success(function(data) {
					$ionicLoading.hide();
					$rootScope.transakcije = data;
					console.log($rootScope.transakcije);

				}).error(function(err) {
					$ionicLoading.hide();
					$scope.upozorenje = true;
				});

};

})

.controller('DetaljiCtrl', function($scope) {
	

});