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
    'setup_enabled' => !setup_enabled,
    'setup_step' => !setup_step
];
PHP;

// get data from post
$data = (isset($_POST['data'])) ? $_POST['data'] : '{}';
$data = json_decode($data, true);
$step = (isset($_POST['step'])) ? intval($_POST['step']) : 0;

// make sure client and server are on the same step
if ($setup->currentStep != $step) {
    $json['error'] = 'wrong_step';
    return_json($json);
}

// run the setup step operations
$warning = [];
switch ($setup->currentStep) {
    case 0:
        $config_new['setup_step']++;
        break;

    case 1:
        if (
            $data['host'] == '' ||
            $data['port'] < 1 ||
            $data['database'] == '' ||
            $data['username'] == ''
        ) {
            $warning[] = [
                'type' => 'warning',
                'title' => 'Invalid input',
                'text' => 'One or more fields are missing or blank.'
            ];
            break;
        }

        // create connection
        $mysqli = new mysqli(
            $data['host'],
            $data['username'],
            $data['password'],
            $data['database'],
            $data['port']
        );

        // check if the connection failed
        if ($mysqli->connect_error) {
            $warning[] = [
                'type' => 'danger',
                'title' => 'Failed to connect',
                'text' => 'Could not connect to the MySQL server with the ' .
                    'information provided, please try again.'
            ];
            break;
        }

        // upload the new database
        $default_sql = file_get_contents(dirname(__FILE__) . '/../default.sql');
        $mysqli->multi_query($default_sql);

        // set new configuration information to save
        $config_new['sql']['host'] = $data['host'];
        $config_new['sql']['port'] = $data['port'];
        $config_new['sql']['database'] = $data['database'];
        $config_new['sql']['username'] = $data['username'];
        $config_new['sql']['password'] = $data['password'];
        $config_new['setup_step']++;
        break;

    case 2:
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

// make a list of warnings to display to user
$json['warning'] = '';
foreach ($warning as $value) {
    $warning_type = $value['type'];
    $warning_title = $value['title'];
    $warning_text = $value['text'];

    // add a new warning.
    $json['warning'] .= <<<HTML
<div class="alert alert-$warning_type alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <strong>$warning_title: </strong>$warning_text
</div>
HTML;
}

// exit if there are any warnings
if ($json['warning'] != '') {
  return_json($json);
}

// save the new configuration file
$json['success'] = ($setup->saveConfigFile(
    $config_new,
    $config_template
) !== false);

return_json($json);
