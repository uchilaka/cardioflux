CardioFlux.controller('NavCtrl', [
    '$rootScope', '$scope', '$contextService',
    function($all, $scope, $context) {
        console.log("[module.controller.Nav]");
        $scope.thisAppName = $context.getAppName();
        console.log("App name -> " + $scope.thisAppName);
        
        $all.toggleMenu = function() {
            $('#appbody').toggleClass('menu-open');
        };
    }
]);