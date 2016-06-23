<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');

defined('YII_TEST_ENTRY_URL') or define('YII_TEST_ENTRY_URL', parse_url(\Codeception\Configuration::config()['config']['test_entry_url'], PHP_URL_PATH));
defined('YII_TEST_ENTRY_FILE') or define('YII_TEST_ENTRY_FILE', __DIR__ . '/../web/index-test.php');
defined('VENDOR_DIR') or define('VENDOR_DIR', __DIR__ . '/../../vendor/');

require_once(__DIR__ . '/../../vendor/autoload.php');
require_once(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');

use AspectMock\Kernel;

// TODO: remove this shitty hack
// without following line test on travis fails
require_once VENDOR_DIR.'/yiisoft/yii2/base/ErrorException.php';

$kernel = Kernel::getInstance();
$kernel->init([
    'debug'        => true,
    'includePaths' => [__DIR__.'/../../', VENDOR_DIR],
    'excludePaths' => [__DIR__],
    'cacheDir'     => __DIR__ . '/../runtime/aop',
]);
$kernel->loadFile(VENDOR_DIR.'/yiisoft/yii2/Yii.php');

$_SERVER['SCRIPT_FILENAME'] = YII_TEST_ENTRY_FILE;
$_SERVER['SCRIPT_NAME'] = YII_TEST_ENTRY_URL;
$_SERVER['SERVER_NAME'] = parse_url(\Codeception\Configuration::config()['config']['test_entry_url'], PHP_URL_HOST);
$_SERVER['SERVER_PORT'] =  parse_url(\Codeception\Configuration::config()['config']['test_entry_url'], PHP_URL_PORT) ?: '80';

Yii::setAlias('@tests', dirname(__DIR__));
Yii::setAlias('@dektrium/user', realpath(__DIR__.'..'));
