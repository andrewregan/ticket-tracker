<?php
require_once(dirname(__FILE__) . '/../prepend.php');

$setup = new Setup(true);
$setup->requireSetupEnabled();

// load the default config file
require(dirname(__FILE__) . '/../config.default.php');

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

// save the new configuration file
$json['success'] = ($setup->saveConfigFile(
    $config_new,
    $config_template
) !== false);

return_json($json);
