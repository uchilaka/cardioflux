angular.module('svc.context', []).factory('$contextService', [
    '$rootScope',
    function($all) {
        $all.appName = 'CardioFlux';
        // check dev or prod
        var config = {
            url: 'http://cardioflux.co/'
        }, __fx = {
            getAppName: function() {
                return $all.appName;
            },
            resource_url: function( uri ) {
                return config.url + uri;
            }
        };
        return __fx;
    }
]);