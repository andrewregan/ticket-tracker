<?php
require_once(dirname(__FILE__) . '/../../resources/prepend.php');

// require that the user is logged out
$login = new Login();
$login->requireLoggedIn();

// get new show information
$id = (isset($_POST['id'])) ? intval($_POST['id']) : 0;

// delete the show
$shows = new Shows();
$shows->deleteShow($id);

return_json(true);
