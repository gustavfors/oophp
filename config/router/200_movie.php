<?php
/**
 * Dice controller
 */
return [
    // Path where to mount the routes, is added to each route path.
    // "mount" => "v2",

    // All routes in order
    "routes" => [
        [
            "info" => "Movie Controller",
            "mount" => "movie",
            "handler" => "\Gufo\Movie\MovieController",
        ],
    ]
];
