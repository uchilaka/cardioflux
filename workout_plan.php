<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$workout_plans = [
    [
        'name' => 'Track Workout',
        'intervals' => [
            'warm_up' => [
                'message' => 'Light 10-minute run around the track'
            ],
            'work' => [
                'distance_m' => 800,
                'incline' => null, // only set for treadmill
                'rate_by_max' => 0.90,
                'work_rest_ratio' => 1,
                'time_sec' => null, // calculated live
                'speed_mph' => null // calculated live
            ],
            'rest' => [
                'time_sec' => null, // calculated - as much time as work interval took
                'speed_mph' => null, // calculated, flexible - light jog
                'message' => 'light walk or jog for same time it took to do work interval',
            ],
            'cool_down' => [
                'message' => '10-minute easy jog'
            ],
            'comments' => 'The distance of the interval can be adjusted from 200 to 1000 meters. Also, length of rest interval can be adjusted'
        ]
    ],
    [
        'name' => 'Treadmill Workout',
        'intervals' => [
            'warm_up' => [
                'message' => '10 minutes of light jogging'
            ],
            'work' => [
                'distance_m' => 800,
                'incline'=>0.05,
                'work_rest_ratio'=>0.5,
                'rate_by_max' => null, // not needed for treadmill. calculated
                'speed_mph'=>3,
                'time_sec'=>60,
            ],
            'rest' => [
                'time_sec'=>120,
                'speed_mph' => 3,
                'message' => 'light walk or jog for same time it took to do work interval',
            ],
            'cool_down' => [
                'message' => '10-minute easy jog'
            ],
            'comments' => 'The distance of the interval can be adjusted from 200 to 1000 meters. Also, length of rest interval can be adjusted'
        ]
    ]
];

header("HTTP/1.1 200 OK");
header("Content-type: application/json");
echo json_encode($workout_plans, JSON_PRETTY_PRINT);