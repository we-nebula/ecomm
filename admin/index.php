<?php

require '../vendor/autoload.php';

$app = new nebula\we\App\Admin();
$app->initLayout('Admin');
$app->init();