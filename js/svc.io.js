angular.module('svc.io', [
    'svc.ext',
    'svc.context'
]).factory('$ioService', [
    '$http', '$extendService', '$contextService', '$q',
    function ($http, $ex, $context, $q) {
        console.log("New context function exists! -> " + angular.isFunction($context['resource_url']));
        var __fx = {
            cancel: function () {
                if (__fx.canceler)
                    __fx.canceler.resolve();
            },
            request: function (method, uri, params, headers, callback) {
                __fx.canceler = $q.defer();
                var URL = /^https?\:\/\//.test(uri) ? uri : $context.resource_url(uri);
                var rq = {
                    url: URL,
                    method: method,
                    accept: "application/json",
                    headers: headers,
                    data: params,
                    timeout: __fx.canceler.promise
                };
                $ex.log(rq, 'POSTing ' + uri);
                $http(rq)
                        .success(function () {
                            $ex.log(arguments, 'RESP ' + uri);
                            if (angular.isFunction(callback))
                                callback.apply(null, arguments);
                        })
                        .error(function () {
                            $ex.log(arguments, 'ERR ' + uri);
                            if (angular.isFunction(callback))
                                callback.apply(null, arguments);
                        });
            },
            get: function (uri, params, headers, callback) {
                var URL = /^https?\:\/\//.test(uri) ? uri : $context.resource_url(uri);
                if (angular.isObject(params)) {
                    URL += '?' + $.param(params);
                }
                var rq = {
                    url: URL,
                    method: 'GET',
                    accept: "application/json",
                    headers: headers
                };
                $ex.log(rq, 'POSTing ' + uri);
                $http(rq)
                        .success(function () {
                            $ex.log(arguments, 'RESP ' + uri);
                            if (angular.isFunction(callback))
                                callback.apply(null, arguments);
                        })
                        .error(function () {
                            $ex.log(arguments, 'ERR ' + uri);
                            if (angular.isFunction(callback))
                                callback.apply(null, arguments);
                        });
            }
        };
        return __fx;
    }
]);