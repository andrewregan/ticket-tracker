<?php
require_once(dirname(__FILE__) . '/../prepend.php');

$setup = new Setup(true);
$setup->requireSetupEnabled();

$config_new = $config;
$config_template = <<<'PHP'
<?php

$config = [
    'sql' => [
        'host' => '!sql_host',
        'port' => !sql_port,
        'table' => '!sql_table',
        'username' => '!sql_username',
        'password' => '!sql_password'
    ],
    'mail' => [
        'host' => '!mail_host',
        'port' => !mail_port,
        'username' => '!mail_username',
        'password' => '!mail_password'
    ],
    'setup_enabled' => !setup_enabled,
    'setup_step' => !setup_step
];
PHP;

// get data from post
$data = (isset($_POST['data'])) ? $_POST['data'] : '{}';
$data = json_decode($data, true);

// run the setup step operations
switch ($setup->currentStep) {
    case 0:
        $config_new['setup_step']++;
        break;

    case 1:
        $config_new['sql']['host'] = $data['host'];
        $config_new['sql']['port'] = $data['port'];
        $config_new['sql']['table'] = $data['table'];
        $config_new['sql']['username'] = $data['username'];
        $config_new['sql']['password'] = $data['password'];
        $config_new['setup_step']++;
        break;

    case 2:
        $config_new['mail']['host'] = $data['host'];
        $config_new['mail']['port'] = $data['port'];
        $config_new['mail']['username'] = $data['username'];
        $config_new['mail']['password'] = $data['password'];
        $config_new['setup_step']++;
        break;

    case 3:
        $config_new['setup_step']++;
        $config_new['setup_enabled'] = false;
        break;

    default:
        $json['error'] = 'unknown_step';
        return_json($json);
}

$json['next_step'] = $config_new['setup_step'];

// save the new configuration file
$json['success'] = ($setup->saveConfigFile(
    $config_new,
    $config_template
) !== false);

return_json($json);
