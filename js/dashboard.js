CardioFlux.controller('DashCtrl', [
    '$rootScope', '$scope', '$extendService', '$contextService',
    function($all, $scope, $ex, $context) {
        $ex.log("[module.controller.Dash]");
        $scope.init = function() {
            $all.bgClass = 'live-bg2';
            $context.layout();
        };
        $scope.init();
    }
]);