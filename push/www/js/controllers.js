angular.module('starter.controllers', [])

.controller('LogoutCtrl', function($scope, $rootScope, $state, $http, $ionicLoading) {
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

.controller('LoginCtrl', function($scope, $rootScope, $ionicLoading, $http, $state) {
  $scope.error = false;
  $scope.alert = false;
  $rootScope.userData = {};
   $scope.loginData = {};

  

$scope.submit = function () {
      $ionicLoading.show({
          template: '<ion-spinner></ion-spinner><br />Please wait...'
        });   
        $http({
          url: "http://oziz.ffos.hr/OMS20142015/0122215735/hackathon/android/login.php",
          data: $scope.loginData,
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
            $state.go("tab.opgovi");
            console.log($rootScope.userData);
          }
          

        }).error(function(err) {
          $ionicLoading.hide();
          $scope.upozorenje = true;
        });
    }

})

.controller('OpgoviCtrl', function($scope, $rootScope, $ionicLoading, $http) {
$scope.favorited = function(item) {
  $scope.data = {
    sifraOPG: $rootScope.userData.sifra,
    sifraKorisnik: $rootScope.userData.korisnik
  }
        $http({
          url: "http://oziz.ffos.hr/OMS20142015/0122215735/hackathon/android/favorite.php",
          data: $scope.data,
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          }
        }).success(function(data) {
            alert("Uspješno pratite ovaj OPG");

        }).error(function(err) {
          
        });
  }

})

.controller('FavoritiCtrl', function($scope, $rootScope, $http, $state, $ionicLoading, $ionicUser, $ionicPush, $log) {
     $scope.identifyUser = function() {
    $log.info('Ionic User: Identifying with Ionic User service');

    var user = $ionicUser.get();
    if(!user.user_id) {
      // Set your user_id here, or generate a random one.
      user.user_id = $ionicUser.generateGUID();
    };

    // Add some metadata to your user object.
    angular.extend(user, {
      name: 'Bio Lega',
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
  $scope.podatak = {
    sifra: $rootScope.userData.sifra
  };
  $rootScope.$on('$cordovaPush:tokenReceived', function(event, data) {
  alert('Got token:' + data.token, data.platform);
  $scope.podatak.device= data.token;
  $scope.sendDevice();
  
});

$scope.sendDevice = function () {
$ionicLoading.show({
          template: '<ion-spinner></ion-spinner><br />Please wait...'
        });   
        $http({
          url: "http://oziz.ffos.hr/OMS20142015/0122215735/hackathon/android/register.php",
          data: $scope.podatak,
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          }
        }).success(function(data) {
          $ionicLoading.hide();
          alert("Uspjeh");
          
        }).error(function(err) {
          $ionicLoading.hide();
          alert("Neuspjeh");
        });  
}

});
