<?php
require_once(dirname(__FILE__) . '/../../resources/prepend.php');

// get all order information
$first_name = (isset($_POST['first_name'])) ? $_POST['first_name'] : '';
$last_name = (isset($_POST['last_name'])) ? $_POST['last_name'] : '';
$phone = (isset($_POST['phone'])) ? $_POST['phone'] : '';
$email = (isset($_POST['email'])) ? $_POST['email'] : '';
$show_id = (isset($_POST['show_id'])) ? intval($_POST['show_id']) : 0;
$seat_num = (isset($_POST['seat_num'])) ? intval($_POST['seat_num']) : 1;
$comments = (isset($_POST['comments'])) ? $_POST['comments'] : '';

// verify that the information is valid
$shows = new Shows(false);
$json['valid_email'] = (preg_match("/^([\w\.])+(@)+([\w])+(\.)+([\w])*$/", $email));
$json['valid_show_id'] = $shows->verifyShow($show_id);
$json['valid_seat_num'] = ($seat_num > 0 && $seat_num < 21);
require_valid($json);

// create the ticket order
$orders = new Orders();
$orders->createOrder(
    $first_name,
    $last_name,
    $phone,
    $email,
    $show_id,
    $seat_num,
    $comments
);

$json['success'] = true;
return_json($json);
