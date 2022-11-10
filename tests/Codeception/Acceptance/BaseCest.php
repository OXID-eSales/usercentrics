<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\Tests\Codeception\Acceptance;

use OxidProfessionalServices\Usercentrics\Tests\Codeception\AcceptanceTester;
use OxidProfessionalServices\Usercentrics\Tests\Codeception\Module\Config;

abstract class BaseCest
{
    private $configBackup;

    public function _before(AcceptanceTester $I, Config $configModule): void
    {
        $this->configBackup = $configModule->getConfiguration();
        $this->prepareConfiguration($configModule);

        $I->saveConfStringVar('usercentricsId', '3j0TmWxNS');
        $I->saveConfStringVar('usercentricsMode', 'CmpV2');
        $I->saveConfBoolVar('developmentAutomaticConsent', false);

        $I->clearShopCache();
    }

    public function _after(AcceptanceTester $I, Config $configModule): void
    {
        $configModule->putConfiguration($this->configBackup);

        $I->saveConfStringVar('usercentricsId', '');
    }

    /**
     * Prepare some test configuration before tests
     */
    protected function prepareConfiguration(Config $configModule)
    {
    }

    protected function waitForUserCentrics($I, $accept = false)
    {
        $I->waitForElement("#usercentrics-root", 10);
        $I->waitForJS("return typeof UC_UI !== 'undefined' && UC_UI !== null && UC_UI.isInitialized()");

        if ($accept) {
            $I->executeJS("UC_UI.acceptAllConsents() && UC_UI.restartCMP()");
        }
    }
}
