<?php
require_once(dirname(__FILE__) . '/../prepend.php');

$setup = new Setup();
$setup->requireSetupEnabled();

$config_new = $config;
$config_template = <<<JSON
{
  "sql": {
    "host": "!sql_host",
    "port": !sql_port,
    "username": "!sql_username",
    "password": "!sql_password"
  },
  "mail": {
    "host": "!mail_host",
    "port": !mail_port,
    "username": "!mail_username",
    "password": "!mail_password"
  },
  "setup_enabled": !setup_enabled,
  "setup_step": !setup_step
}
JSON;

// get data from post
$data = (isset($_POST['data'])) ? $_POST['data'] : '{}';
$data = json_decode($data, true);

// run the setup step operations
switch ($setup->currentStep) {
    case 0:
        $config_new['setup_step'] = 1;
        break;

    default:
        $json['error'] = 'unknown_step';
        return_json($json);
}

// save the new configuration file
$json['success'] = $setup->saveConfigFile(
    $config_new,
    $config_template
);

return_json($json);
