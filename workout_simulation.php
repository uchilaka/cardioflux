<?php
/** recovering @ < 12 beats / minute => at risk for heart disease **/

define('REQUEST_METHOD_GET', 'GET');
define('REQUEST_METHOD_POST', 'POST');

function safevariable($key, $method = REQUEST_METHOD_GET, $default = null) {
    switch ($method) {
        case REQUEST_METHOD_GET:
            return empty($_GET[$key]) ? $default : $_GET[$key];

        case REQUEST_METHOD_POST:
            return empty($_POST[$key]) ? $default : $_POST[$key];
    }
}

function csvalue($value) {
    if(is_numeric($value)) {
        return $value;
    } else {
        return "\"{$value}\"";
    }
}

$age = 29;
$maxBPM = 220 - $age;
$startingBPM = 68;
$recoveryRate = 0.015;
$accelerationRate = 0.025;
$workToRestRatio = 0.5; // $work_time / $rest_time
$workTime = 1 * 60; // 1 minute
# initialize
$currentBPM = $startingBPM;
$datafeed = [];

# simulate warm up heart rate
$minutes = 1;
$elapsedSeconds = 0;
$currentDuration = 10 * 60; // 10 mins
$targetRateToMax = 0.75;
$zone = 'warm_up';
for ($currentDuration; $currentDuration > 0; $currentDuration--) {
    ++$elapsedSeconds;
    $currentBPM += $currentBPM * $accelerationRate;
    $currentBPM = min(round($currentBPM), $maxBPM * $targetRateToMax);
    $datafeed[] = [
        'secs' => $elapsedSeconds,
        'bpm' => rand($currentBPM, $currentBPM - 3),
        'zone' => $zone
    ];
}

$cycles = 10;
for ($cycles; $cycles > 0; $cycles--) {
    $zone = 'work';
# simulate work heart rate
    $currentDuration = $workTime; // 1 minute
    $targetRateToMax = 0.90;
    for ($currentDuration; $currentDuration > 0; $currentDuration--) {
        ++$elapsedSeconds;
        $currentBPM += $currentBPM * $accelerationRate;
        $currentBPM = min(round($currentBPM), $maxBPM * $targetRateToMax);
        $datafeed[] = [
            'secs' => $elapsedSeconds,
            'bpm' => rand($currentBPM, $currentBPM - 3),
            'zone' => $zone
        ];
    }

# simulate rest cycle 
    $currentDuration = $workToRestRatio * $workTime; // 30 seconds
    $targetRateToMax = 0.50;
    $zone = 'rest';
    for ($currentDuration; $currentDuration > 0; $currentDuration--) {
        ++$elapsedSeconds;
        $currentBPM -= $currentBPM * $accelerationRate;
        $currentBPM = max(round($currentBPM), $maxBPM * $targetRateToMax);
        $datafeed[] = [
            'secs' => $elapsedSeconds,
            'bpm' => rand($currentBPM, $currentBPM - 3),
            'zone' => $zone
        ];
    }
}
$dataset = (object)[
    'maxBPM' => $maxBPM,
    'age' => $age,
    'data' => $datafeed
];

header("HTTP/1.1 200 OK");
$format = safevariable('format');
switch ($format) {
    case 'csv':
        header("Content-type: text/csv");
        $headers = ['zone', 'secs', 'bpm'];
        $delim = ",";
        echo implode($delim, $headers) . PHP_EOL;
        foreach($dataset->data as $row) {
            echo implode($delim, [csvalue($row['zone']), csvalue($row['secs']), csvalue($row['bpm'])]) . PHP_EOL;
        }
        break;

    default:
        header("Content-type: application/json");
        echo json_encode($dataset, JSON_PRETTY_PRINT);
}
