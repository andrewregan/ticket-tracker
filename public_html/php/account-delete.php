<?php
require_once(dirname(__FILE__) . '/../../resources/prepend.php');

// require that the user is logged out
$login = new Login();
$login->requireLoggedIn();

// get account id
$id = (isset($_POST['id'])) ? intval($_POST['id']) : 0;

// delete the account
$accounts = new Accounts();
$accounts->deleteAccount($id);

return_json(true);
