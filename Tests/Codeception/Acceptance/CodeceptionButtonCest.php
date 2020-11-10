<?php

declare(strict_types=1);

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidProfessionalServices\Usercentrics\Tests\Codeception\Acceptance;

use OxidEsales\Codeception\Page\Home;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidProfessionalServices\Usercentrics\Tests\Codeception\AcceptanceTester;

final class CodeceptionButtonCest
{
    /**
     * @param AcceptanceTester $I
     * @throws \Exception
     */
    public function frontPageWorks(AcceptanceTester $I)
    {
        $homePage = new Home($I);
        $I->amOnPage($homePage->URL);
        $I->waitForElement("#usercentrics-button", 1);
        $I->seeElement("#usercentrics-button");
    }
}
