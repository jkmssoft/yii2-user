<?php

// NOTE: Make sure this file is not accessible when deployed to production
if (!in_array(@$_SERVER['REMOTE_ADDR'], ['127.0.0.1', '::1'])) {
    die('You are not allowed to access this file.');
}

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');

$dir = __DIR__;
while (!file_exists($dir . '/vendor/autoload.php')) {
//    echo "Testing $dir\n";
    if ($dir == dirname($dir)) {
        throw new \Exception('Failed to locate autoload.php');
    }
    $dir = dirname($dir);
}
$vendor = $dir . '/vendor';

require($vendor.'/autoload.php');
require($vendor.'yiisoft/yii2/Yii.php');

//require(__DIR__ . '/../../vendor/autoload.php');
//require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/../codeception/config/acceptance.php');

(new yii\web\Application($config))->run();
