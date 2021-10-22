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
     * @group usercentrics
     */
    public function scriptIncludeDecorated(AcceptanceTester $I, Config $configModule)
    {
        $homePage = new Home($I);
        $I->amOnPage($homePage->URL);

        $basketSteps = new BasketSteps($I);
        $basketSteps->addProductToBasketAndOpenBasket('dc5ffdf380e15674b56dd562a7cb6aec', 1);

        $value = $I->grabAttributeFrom("//script[@data-oxid][1]", "data-oxid");
        $this->prepareSpecialConfiguration($configModule, $value);
        $I->reloadPage();

        $I->waitForElement("//script[@data-oxid='{$value}'][@data-usercentrics='testcustomservice'][@type='text/plain']");

        // Accept cookie policy
        $this->waitForUserCentrics($I, true);

        $I->waitForElement("//script[@data-oxid='{$value}'][@type='text/javascript']");
    }

    /**
     * Prepare some test configuration before tests
     */
    protected function prepareSpecialConfiguration(Config $configModule, string $value): void
    {
        $config = new Configuration(
            [ //services
                new Service('testcustomservice', 'testcustomservice')
            ],
            [],
            [ //snippets
                new ScriptSnippet($value, 'testcustomservice')
            ]
        );
        $configModule->putConfiguration($config);
    }
}
