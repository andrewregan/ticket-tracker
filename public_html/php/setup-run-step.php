<?php
require_once(dirname(__FILE__) . '/../../resources/prepend.php');

$setup = new Setup(true);
$setup->requireSetupEnabled();

$config_new = $config;
$config_template = <<<'PHP'
<?php

$config = [
    'sql' => [
        'host' => '!sql_host',
        'port' => !sql_port,
        'database' => '!sql_database',
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
        $default_sql = file_get_contents(dirname(__FILE__) .
            '/../../resources/default.sql');
        $mysqli->multi_query($default_sql);

        $mysqli->close();

        // set new configuration information to save
        $config_new['sql']['host'] = $data['host'];
        $config_new['sql']['port'] = $data['port'];
        $config_new['sql']['database'] = $data['database'];
        $config_new['sql']['username'] = $data['username'];
        $config_new['sql']['password'] = $data['password'];
        $config_new['setup_step']++;
        break;

    case 2:
        $settings = new Settings(false);

        // save the mail settings
        $settings->changeSetting('mail_host', $data['host']);
        $settings->changeSetting('mail_port', $data['port']);
        $settings->changeSetting('mail_username', $data['username']);
        $settings->changeSetting('mail_password', $data['password']);

        $config_new['setup_step']++;
        break;

    case 3:
        $accounts = new Accounts();

        // check if the email given is correct
        if (!$accounts->checkEmail($data['username'])) {
            $warning[] = [
                'type' => 'warning',
                'title' => 'Invalid email',
                'text' => 'The email that you entered is not valid, please ' .
                    'enter a valid email address.'
            ];
            break;
        }

        // check if password is not strong enough
        if (!$accounts->checkPassword($data['password'])) {
            $warning[] = [
                'type' => 'warning',
                'title' => 'Weak password',
                'text' => 'The password you entered is not strong enough; ' .
                    'passwords must contain a lowercase and uppercase ' .
                    'character as well as a number or special character.'
            ];
            break;
        }

        $accounts->createAccount($data['username'], $data['password']);
        $warning[] = [
            'type' => 'success',
            'title' => 'Setup complete',
            'text' => 'The setup is now finished, you will be redirected in ' .
                'a few seconds. Log in with your username and password.'
        ];

        // setup is now complete
        $config_new['setup_step']++;
        $config_new['setup_enabled'] = false;
        break;

    default:
        $json['error'] = 'unknown_step';
        return_json($json);
}

$json['next_step'] = $config_new['setup_step'];

// make a list of warnings to display to user
$success = true;
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

    if ($warning_type !== 'success') $success = false;
}

// exit if there are any bad warnings
if (!$success) return_json($json);

// save the new configuration file
$json['success'] = ($setup->saveConfigFile(
    $config_new,
    $config_template
) !== false);

return_json($json);
