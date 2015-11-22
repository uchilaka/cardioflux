<?php

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

header("Content-type: application/json");
echo json_encode([
    'maxBPM' => $maxBPM,
    'age' => $age,
    'data' => $datafeed
        ], JSON_PRETTY_PRINT);
