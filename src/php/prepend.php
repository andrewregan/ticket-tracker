<?php
/*
  This file should be required in every php file.
  require_once('../php/prepend.php');
*/

// Automatically load any classes.
spl_autoload_register(function ($class_name) {
  $class_path = explode('_', $class_name);
  $file_path = 'classes/' . implode('/', $class_path) . '.php';
  require_once($file_path);
});

// Return json when a script ends.
function return_json($json) {
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

// Save a string to a file.
function save_file($file, $code) {
  $file_handle = fopen($file, 'w');
  $success = (fwrite($file_handle, $code) === true);
  fclose($file_handle);

  return $success;
}

// Return an array from a json file.
function load_json_file($file) {
  if (!file_exists($file)) return false;

  $json = file_get_contents($file);
  return json_decode($json, true);
}

// Load the config file if it exists.
if (file_exists('config.json')) {
  $config = load_json_file(dirname(__FILE__) . '/config.json');
} else {
  $config = load_json_file(dirname(__FILE__) . '/config.default.json');
}
