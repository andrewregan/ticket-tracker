<?php
require_once(dirname(__FILE__) . '/../../resources/prepend.php');

// require that the user is logged out
$login = new Login(false);
$login->requireLoggedIn(false);

// check if there are attempts to break into account
$log = new Log();
$login_attempts = $log->getEventCountByIP(
    'LOGIN_FAIL',
    $_SERVER['REMOTE_ADDR'],
    1
);

// prevent unlimited account guessing
if ($login_attempts > 9) {
    $json['error'] = 'too_many_attempts';
    return_json($json);
}

// get user email and password
$email = (isset($_POST['email'])) ? $_POST['email'] : '';
$password = (isset($_POST['password'])) ? $_POST['password'] : '';

// attempt to make the new login session
$json['success'] = $login->createLoginSession($email, $password);
if (!$json['success']) $log->logEvent('LOGIN_FAIL', '');

return_json($json);
