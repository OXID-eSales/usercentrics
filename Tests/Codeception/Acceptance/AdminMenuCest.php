<?php

namespace OxidProfessionalServices\Usercentrics\Tests\Codeception\Acceptance;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidProfessionalServices\Usercentrics\Tests\Codeception\AcceptanceTester;


/**
 * @group Admin
 */
class AdminMenuCest
{
    public function testMenuAvailable(AcceptanceTester $I)
    {
        $adminLoginPage = $I->openAdminLoginPage();
        $adminLoginPage->login('admin', 'admin');

        $I->selectNavigationFrame();
        $I->see(Translator::translate('oxps_cookieconsent'));
    }
}