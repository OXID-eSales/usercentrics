<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\Tests\Codeception\Acceptance;

use OxidEsales\Codeception\Page\Home;
use OxidProfessionalServices\Usercentrics\DataObject\Configuration;
use OxidProfessionalServices\Usercentrics\DataObject\Script;
use OxidProfessionalServices\Usercentrics\DataObject\ScriptSnippet;
use OxidProfessionalServices\Usercentrics\DataObject\Service;
use OxidProfessionalServices\Usercentrics\Tests\Codeception\AcceptanceTester;
use OxidProfessionalServices\Usercentrics\Tests\Codeception\Module\Config;

final class ScriptIncludeAdjustementCest
{
    private $configBackup;

    public function _before(AcceptanceTester $I, Config $configModule): void
    {
        $this->configBackup = $configModule->getConfiguration();
        $this->prepareConfiguration($configModule);
    }

    public function _after(AcceptanceTester $I, Config $configModule): void
    {
        $configModule->putConfiguration($this->configBackup);
    }

    /**
     * @param AcceptanceTester $I
     *
     * @group sieg
     */
    public function scriptIncludeDecorated(AcceptanceTester $I)
    {
        $homePage = new Home($I);
        $I->amOnPage($homePage->URL);
        $I->waitForElement("//button[@id='uc-btn-accept-banner']", 60);
        $I->click("//button[@id='uc-btn-accept-banner']");

        $I->canSeeElementInDOM("//script[@type='text/javascript'][@data-usercentrics='testcustomservice']");
    }

    /**
     * Prepare some test configuration before tests
     */
    private function prepareConfiguration(Config $configModule)
    {
        $config = new Configuration(
            [ //scripts
                new Script('js/libs/jquery.min.js', 'testcustomservice')
            ],
            [ //services
                new Service('testcustomservice', 'testcustomservice')
            ],
            [ //snippets
                new ScriptSnippet('123', 'testcustomservice')
            ]
        );
        $configModule->putConfiguration($config);
    }
}
