CardioFlux.controller('WorkoutCtrl', [
    '$rootScope', '$scope', '$extendService', '$ioService', '$contextService',
    function($rootScope, $scope, $ex, $io, $context) {
        console.log("[module.controller.Workout]");
        
        $scope.simulate = function() {
            $ex.log("[start simulation]");
            $io.get($context.resource_url('workout_simulation.php'), {}, {
                Authorization: ''
            }, function(response, status) {
                $ex.log(arguments, '/workout_simulation.php RESP');
            });
        };
        
        $scope.init = function() {
            var params = $ex.getRawParameters();
            $ex.log(params, 'RAW params');
            if(params.start_workout) {
                $scope.simulate();
            }
        };
        $scope.init();
        
    }
]);