<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\Tests\Codeception\Acceptance;

use OxidEsales\Codeception\Page\Home;
use OxidProfessionalServices\Usercentrics\Tests\Codeception\Support\AcceptanceTester;

final class UsercentricsButtonCest extends BaseCest
{
    /**
     * @throws \Exception
     * @group usercentrics
     */
    public function frontPageWorksAndShowsUsercentricsWallOrBanner(AcceptanceTester $I): void
    {
        $homePage = new Home($I);
        $I->amOnPage($homePage->URL);

        $this->waitForUsercentrics($I);
    }
}
