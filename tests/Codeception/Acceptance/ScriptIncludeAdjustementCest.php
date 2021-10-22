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
     * @group usercentrics
     */
    public function scriptIncludeDecoratedNotAccepted(AcceptanceTester $I)
    {
        $homePage = new Home($I);
        $I->amOnPage($homePage->URL);

        $I->seeElementInDOM("//script[@type='text/plain'][@data-usercentrics='testcustomservice']");
        $this->waitForUserCentrics($I, false);

        $I->seeElementInDOM("//script[@type='text/plain'][@data-usercentrics='testcustomservice']");
    }

    /**
     * @param AcceptanceTester $I
     * @group usercentrics
     */
    public function scriptIncludeDecoratedAccepted(AcceptanceTester $I)
    {
        $homePage = new Home($I);
        $I->amOnPage($homePage->URL);

        $I->seeElementInDOM("//script[@type='text/plain'][@data-usercentrics='testcustomservice']");
        $this->waitForUserCentrics($I, true);

        $I->dontSeeElementInDOM("//script[@type='text/plain'][@data-usercentrics='testcustomservice']");
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
