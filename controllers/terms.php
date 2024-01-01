<?php

$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = $setting['name'] . " | Terms";

$context = [
    'title'=> $title,
    'setting'=> $setting
];

landing_view('terms', $context);