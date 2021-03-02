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

        $I->saveShopConfVar('string', 'usercentricsId', '3j0TmWxNS', 1, 'module:oxps_usercentrics');
        $I->saveShopConfVar('string', 'usercentricsMode', 'CmpV1', 1, 'module:oxps_usercentrics');

        $I->clearShopCache();
    }

    public function _after(AcceptanceTester $I, Config $configModule): void
    {
        $configModule->putConfiguration($this->configBackup);

        $I->saveShopConfVar('string', 'usercentricsId', '', 1, 'module:oxps_usercentrics');
    }

    /**
     * Prepare some test configuration before tests
     */
    protected function prepareConfiguration(Config $configModule)
    {
    }
}
