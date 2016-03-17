<?php
/*
    This file should be required in every php file.
    require_once(dirname(__FILE__) . '/../php/prepend.php');
*/

// Automatically load any classes.
spl_autoload_register(function ($class_name) {
    $class_path = explode('_', $class_name);
    $file_path = 'classes/' . implode('/', $class_path) . '.php';
    require_once($file_path);
});

// Return json when a script ends.
function return_json($json = false) {
    // If no arguements are passed, success is false.
    if ($json === false) $json = ['success' => false];

    // If a true value is passed, success is true!
    if ($json === true) $json = ['success' => true];

    // Assume that success is false if not true.
    if (!isset($json['success'])) $json['success'] = false;

    // Output the script's total execution time.
    $json['exec_time'] = number_format(microtime(true) -
        $_SERVER["REQUEST_TIME_FLOAT"], 4);

    // Output the JSON code and stop the script.
    exit(json_encode($json));
}

// Used by the scripts to validate inputs.
function require_valid($json) {
    foreach ($json as $key => $value) {
        // If any valid_ key is not true, exit.
        if (substr($key, 0, 6) == 'valid_' && $value != true) return_json($json);
    }
}

// Load the config file if it exists.
if (file_exists(dirname(__FILE__) . '/config.php')) {
    require(dirname(__FILE__) . '/config.php');
} else {
    require(dirname(__FILE__) . '/config.default.php');
}
