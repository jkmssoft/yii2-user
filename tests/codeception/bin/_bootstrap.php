<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');

defined('DEKTRIUM_USER_BASE_PATH') or define('DEKTRIUM_USER_BASE_PATH', dirname(dirname(dirname(__DIR__))));

require(DEKTRIUM_USER_BASE_PATH . '/vendor/autoload.php');
require(DEKTRIUM_USER_BASE_PATH . '/vendor/yiisoft/yii2/Yii.php');

Yii::setAlias('@tests', dirname(dirname(__DIR__)));
