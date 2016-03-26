<?php
require_once(dirname(__FILE__) . '/../../resources/prepend.php');

$login = new Login();
$login->requireLoggedIn();

$settings = new Settings();
$json['site_title'] = $settings->getSetting('site_title');
$json['site_theme'] = $settings->getSetting('site_theme');
$json['site_disable'] = $settings->getSetting('site_disable');

$shows = new Shows(true);
$json['shows'] = $shows->table;

$accounts = new Accounts();
$accounts->loadAccountList();
$json['accounts'] = $accounts->table;

$json['success'] = true;
return_json($json);
