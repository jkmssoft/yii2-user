<?php

namespace tests\codeception\unit;

use tests\codeception\fixtures\TokenFixture;
use tests\codeception\fixtures\ProfileFixture;
use tests\codeception\fixtures\UserFixture;

class TestCase extends \yii\codeception\TestCase
{
    public $appConfig = '@tests/codeception/config/unit.php';

    protected function setUp()
    {
        parent::setUp();
        $this->loadFixtures();
    }

    public function fixtures()
    {
        return[
            ProfileFixture::className(),
            TokenFixture::className(),
            UserFixture::className(),
        ];
    }
}
