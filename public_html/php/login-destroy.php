<?php
require_once(dirname(__FILE__) . '/../../resources/prepend.php');

$login = new Login(false);
$login->destroyLoginSession();

return_json(true);
