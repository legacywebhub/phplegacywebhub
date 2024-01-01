<?php

$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = $setting['name'] . " | About Us";

$context = [
    'title'=> $title,
    'setting'=> $setting
];

landing_view('about', $context);