<?php

$setting = query_fetch("SELECT * FROM settings ORDER BY id DESC LIMIT 1")[0];
$title = $setting['name'] . " | Home Page";
$plans = query_fetch("SELECT * FROM plans");

$context = [
    'setting'=> $setting,
    'title'=> $title,
    'plans'=> $plans
];

landing_view('home', $context);