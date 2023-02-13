<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\Tests\Codeception\Acceptance;

use OxidEsales\Codeception\Step\Basket;
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
        $I->updateConfigInDatabase('iNewBasketItemMessage', 2, 'str');
        $basket = new Basket($I);

        $I->openShop();
        $basket->addProductToBasket('1000', 1);

        $value = $I->grabAttributeFrom("//script[@data-oxid][1]", "data-oxid");
        $this->prepareSpecialConfiguration($configModule, $value);

        $I->openShop();
        $basket->addProductToBasket('1000', 1);

        $I->waitForElement("//script[@data-oxid='$value'][@data-usercentrics='testcustomservice'][@type='text/plain']");
        $this->waitForUserCentrics($I, true); // Accept cookie policy
        $I->waitForElement("//script[@data-oxid='$value'][@type='text/javascript']");
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
