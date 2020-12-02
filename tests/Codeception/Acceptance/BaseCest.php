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
        $I->updateConfigInDatabase('usercentricsId', '3j0TmWxNS', 'string');

        $I->clearShopCache();
        $this->configBackup = $configModule->getConfiguration();
        $this->prepareConfiguration($configModule);
    }

    public function _after(AcceptanceTester $I, Config $configModule): void
    {
        $I->updateConfigInDatabase('usercentricsId', '', 'string');
        $configModule->putConfiguration($this->configBackup);
    }

    /**
     * Prepare some test configuration before tests
     */
    protected function prepareConfiguration(Config $configModule)
    {
    }
}
