<?php
require_once(dirname(__FILE__) . '/../../resources/prepend.php');

$login = new Login();
$login->requireLoggedIn();

// send the current settings
$settings = new Settings();
$json['site_title'] = $settings->getSetting('site_title');
$json['site_theme'] = $settings->getSetting('site_theme');
$json['site_disable'] = $settings->getSetting('site_disable');

// send information for the shows
$shows = new Shows(true);
$json['shows'] = $shows->table;

// send information for the accounts
$accounts = new Accounts();
$accounts->loadAccountList();
$json['accounts'] = $accounts->table;

$json['success'] = true;
return_json($json);
