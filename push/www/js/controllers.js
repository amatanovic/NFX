angular.module('starter.controllers', [])

.controller('LogoutCtrl', function($scope, $rootScope, $state) {
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



  $scope.identifyUser = function() {
    $log.info('Ionic User: Identifying with Ionic User service');

    var user = $ionicUser.get();
    if(!user.user_id) {
      // Set your user_id here, or generate a random one.
      user.user_id = $ionicUser.generateGUID();
    };

    // Add some metadata to your user object.
    angular.extend(user, {
      name: 'Ionitron',
      bio: 'I come from planet Ion'
    });

    // Identify your user with the Ionic User Service
    $ionicUser.identify(user).then(function(){
      $scope.identified = true;
      $scope.pushRegister();
    });
  };
 


})

.controller('LoginCtrl', function($scope, $rootScope, $http, $state, $ionicLoading, $ionicUser, $ionicPush, $log) {
  $scope.error = false;
  $scope.alert = false;
  $rootScope.userData = {};
   $scope.loginData = {};

     $scope.doLogin = function () {
     // if ($scope.loginData.email === "" || $scope.loginData.lozinka === "") {
       //$scope.error = true;
       //}
    if ($scope.loginData.email !== "" || $scope.loginData.lozinka !== "") {
      $scope.success = false;
      $scope.identifyUser();
      $ionicLoading.show({
          template: '<ion-spinner></ion-spinner><br />Please wait...'
        });   
    }
    };
    $scope.identifyUser = function() {
    $log.info('Ionic User: Identifying with Ionic User service');

    var user = $ionicUser.get();
    if(!user.user_id) {
      // Set your user_id here, or generate a random one.
      user.user_id = $ionicUser.generateGUID();
    };

    // Add some metadata to your user object.
    angular.extend(user, {
      name: $scope.loginData.email,
      bio: 'OPG Hackathon'
    });

    // Identify your user with the Ionic User Service
    $ionicUser.identify(user).then(function(){
      $scope.identified = true;
      $scope.pushRegister();
    });
  };
   $scope.pushRegister = function() {
    $log.info('Ionic Push: Registering user');

    // Register with the Ionic Push service.  All parameters are optional.
    $ionicPush.register({
      canShowAlert: true, //Can pushes show an alert on your screen?
      canSetBadge: true, //Can pushes update app icon badges?
      canPlaySound: true, //Can notifications play a sound?
      canRunActionsOnWake: true, //Can run actions outside the app,
      onNotification: function(notification) {
        // Handle new push notifications here
        // $log.info(notification);
        return true;
      }
    });
  };
   $rootScope.$on('$cordovaPush:tokenReceived', function(event, data) {
  alert('Got token:' + data.token, data.platform);
  $scope.loginData.device = data.token;
  $scope.submit();
});

$scope.submit = function () {
  $http({
          url: "http://localhost/nfx/android/login.php",
          data: $scope.loginData,
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          }
        }).success(function(data) {
          $rootScope.userData = data;
          $ionicLoading.hide();
          $state.go('tab.opgovi');
          $ionicLoading.hide();
          if (data == false) {
            $scope.error = true;
          }

        }).error(function(err) {
          $ionicLoading.hide();
          $scope.alert = true;
        });
}

})

.controller('OpgoviCtrl', function($scope) {
})

.controller('FavoritiCtrl', function($scope) {
 
});
