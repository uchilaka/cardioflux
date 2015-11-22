angular.module('svc.context', []).factory('$contextService', [
    '$rootScope',
    function($all) {
        $all.appName = 'CardioFlux';
        var __fx = {
            getAppName: function() {
                return $all.appName;
            }
        };
        return __fx;
        
    }
]);