CardioFlux.controller('WorkoutCtrl', [
    '$rootScope', '$scope', '$extendService', '$ioService', '$contextService', '$interval', '$filter',
    function ($all, $scope, $ex, $io, $context, $interval, $filter) {
        console.log("[module.controller.Workout]");
        
        $scope.runningSimulation = null;
        $scope.currentRateIndex = 0;
        $scope.currentData = {};
        
        $scope.Zones = {
            warm_up: {
                label: 'Warm Up'
            },
            rest: {
                label: 'Rest'
            },
            work: {
                label: 'Work'
            }
        };
        
        $scope.simulate = function () {
            $ex.log("[starting simulation...]");
            $io.get($context.resource_url('workout_simulation.php'), {}, {
                Authorization: ''
            }, function (response, status) {
                $ex.log(arguments, '/workout_simulation.php RESP');
                switch(status) {
                    case 200:
                        $scope.dataset = response;
                        $ex.log("[Running simulation...]");
                        $scope.runningSimulation = $interval(function() {
                            $scope.currentData = $scope.dataset.data[$scope.currentRateIndex];
                            $scope.currentData.targetBPM = parseFloat($scope.currentData.targetBPM) * 100;
                            $scope.currentRateIndex += 1;
                            if($scope.currentRateIndex===5) {
                                $scope.callout = {
                                    title: 'Doing Great!',
                                    message: 'Try to hold your current heart rate'
                                };
                            }
                            $ex.log("Simulation at " + $scope.currentRateIndex + "...");
                            if($scope.lastZone && $scope.lastZone != $scope.currentData.zone) {
                                $scope.callout = {
                                    title: "Switch it up!",
                                    message: "Aim for the new BPM"
                                };
                            }
                            $scope.lastZone = $scope.currentData.zone;
                        }, 1000, 0, true);
                        break;
                }
            });
        };

        $scope.init = function () {
            $all.bgClass = 'live-bg1';
            var params = $ex.getRawParameters();
            $ex.log(params, 'RAW params');
            if (params.start_workout) {
                $scope.simulate();
            }
        };
        $scope.init();

    }
]);