CardioFlux.controller('WorkoutCtrl', [
    '$rootScope', '$scope', '$extendService', '$ioService',
    function($rootScope, $scope, $ex, $io) {
        console.log("[module.controller.Workout]");
        
        $scope.simulate = function() {
            $ex.log("[start simulation]");
            $io.get('workout_simulation.php', {}, {
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