<?php

use dektrium\user\tests\FunctionalTester;
use tests\codeception\_pages\LoginPage;

$I = new FunctionalTester($scenario);
$I->wantTo('ensure that login works');

$page = LoginPage::openBy($I);

$I->amGoingTo('try to login with empty credentials');
$page->login('', '');
$I->expectTo('see validations errors');
$I->see('Login cannot be blank.');
$I->see('Password cannot be blank.');

$I->amGoingTo('try to login with unconfirmed account');
$user = $I->getFixture('user')->getModel('unconfirmed');
$page->login($user->email, 'qwerty');
$I->see('You need to confirm your email address');

$I->amGoingTo('try to login with blocked account');
$user = $I->getFixture('user')->getModel('blocked');
$page->login($user->email, 'qwerty');
$I->see('Your account has been blocked');

$enableActivationByAdminIsRequiredBefore = \Yii::$container->get(\dektrium\user\Module::className(), [
    'enableActivationByAdminIsRequired'
]);
\Yii::$container->set(\dektrium\user\Module::className(), [
    'enableActivationByAdminIsRequired' => true,
]);
$I->amGoingTo('try to login with not activated account');
$user = $I->getFixture('user')->getModel('notactivated');
$page->login($user->email, 'qwerty');
$I->see('Your account has not yet been activated by an administrator');
\Yii::$container->set(\dektrium\user\Module::className(), [
    'enableActivationByAdminIsRequired' => $enableActivationByAdminIsRequiredBefore,
]);


$I->amGoingTo('try to login with wrong credentials');
$user = $I->getFixture('user')->getModel('user');
$page->login($user->email, 'wrong');
$I->expectTo('see validations errors');
$I->see('Invalid login or password');

$I->amGoingTo('try to login with correct credentials');
$page->login($user->email, 'qwerty');
$I->dontSee('Login');
$I->see('Logout');
