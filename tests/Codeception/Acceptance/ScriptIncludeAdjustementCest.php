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
use OxidProfessionalServices\Usercentrics\DataObject\Service;
use OxidProfessionalServices\Usercentrics\Tests\Codeception\AcceptanceTester;
use OxidProfessionalServices\Usercentrics\Tests\Codeception\Module\Config;

final class ScriptIncludeAdjustementCest extends BaseCest
{
    /**
     * @param AcceptanceTester $I
     * @group includeScript
     */
    public function scriptIncludeDecorated(AcceptanceTester $I)
    {
        $homePage = new Home($I);
        $I->amOnPage($homePage->URL);

        // Accept cookie policy
        $I->waitForElement("//button[@id='uc-btn-accept-banner']", 10);
        $I->click("//button[@id='uc-btn-accept-banner']");

        $I->waitForElement("//script[@type='text/javascript'][@data-usercentrics='testcustomservice']");
    }

    /**
     * Prepare some test configuration before tests
     */
    protected function prepareConfiguration(Config $configModule)
    {
        $config = new Configuration(
            [ //services
                new Service('testcustomservice', 'testcustomservice')
            ],
            [ //scripts
                new Script('.min.js', 'testcustomservice')
            ],
            []
        );
        $configModule->putConfiguration($config);
    }
}
