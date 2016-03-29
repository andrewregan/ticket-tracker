<?php
require_once(dirname(__FILE__) . '/../../resources/prepend.php');

$shows = new Shows();
$json['shows'] = [];
foreach ($shows->table as $key => $value) {
    if ($value['enabled']) {
        $json['shows'][] = $value;
    }
}

$json['success'] = true;
return_json($json);
