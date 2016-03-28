<?php
require_once(dirname(__FILE__) . '/../../resources/prepend.php');

// require that the user is logged out
$login = new Login();
$login->requireLoggedIn();

// get new show information
$show_title = (isset($_POST['show_title'])) ? $_POST['show_title'] : '';
$seat_total = (isset($_POST['seat_total'])) ? intval($_POST['seat_total']) : 0;
$seat_cost = (isset($_POST['seat_cost'])) ? intval($_POST['seat_cost']) : 0;
$enabled = (isset($_POST['enabled']) && $_POST['enabled'] == 'true');

// create the new show
$shows = new Shows();
$shows->createShow($show_title, $seat_total, $seat_cost, $enabled);

return_json(true);
