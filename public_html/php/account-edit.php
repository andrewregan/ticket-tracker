<?php
require_once(dirname(__FILE__) . '/../../resources/prepend.php');

// require that the user is logged out
$login = new Login();
$login->requireLoggedIn();

// get account email and password
$email = (isset($_POST['email'])) ? $_POST['email'] : '';
$password = (isset($_POST['password'])) ? $_POST['password'] : '';
$id = (isset($_POST['id'])) ? int($_POST['id']) : 0;

// verify if the information is valid
$accounts = new Accounts();

// get the account info for the id
$account_info = $accounts->getAccountInfo($id);
$json['valid_id'] = ($account_info !== false);

// verify that the new email is valid
if ($email !== '' && $email !== $account_info['email']) {
    $json['valid_email'] = $this->checkEmail($email);
} else {
    $json['valid_email'] = true;
}

// verify that the new password is valid
if ($password !== '') {
    $json['valid_password'] = $this->checkPassword($password);
} else {
    $json['valid_password'] = true;
}

require_valid($json);

$accounts->editAccount($id, $email, $password);
return_json($json);
