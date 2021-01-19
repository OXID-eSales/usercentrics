<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\Tests\Codeception\Acceptance;

use OxidEsales\Codeception\Page\Home;
use OxidEsales\Codeception\Step\Basket as BasketSteps;
use OxidProfessionalServices\Usercentrics\DataObject\Configuration;
use OxidProfessionalServices\Usercentrics\DataObject\ScriptSnippet;
use OxidProfessionalServices\Usercentrics\DataObject\Service;
use OxidProfessionalServices\Usercentrics\Tests\Codeception\AcceptanceTester;
use OxidProfessionalServices\Usercentrics\Tests\Codeception\Module\Config;

final class ScriptSnippetAdjustementCest extends BaseCest
{
    /**
     * @param AcceptanceTester $I
     */
    public function scriptIncludeDecorated(AcceptanceTester $I)
    {
        $homePage = new Home($I);
        $I->amOnPage($homePage->URL);

        // Accept cookie policy
        $I->waitForElement("//button[@id='uc-btn-accept-banner']", 10);
        $I->click("//button[@id='uc-btn-accept-banner']");

        $basketSteps = new BasketSteps($I);
        $basketSteps->addProductToBasketAndOpenBasket('dc5ffdf380e15674b56dd562a7cb6aec', 1);

        $I->canSeeElementInDOM("//script[@data-oxid='3a1dcde97b93a66a76388c69f9c04741'][@data-usercentrics='testcustomservice'][@type='text/javascript']");
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
            [],
            [ //snippets
                new ScriptSnippet('3a1dcde97b93a66a76388c69f9c04741', 'testcustomservice')
            ]
        );
        $configModule->putConfiguration($config);
    }
}
