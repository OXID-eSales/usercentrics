<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\Tests\Codeception\Acceptance;

use OxidEsales\Codeception\Page\Home;
use OxidProfessionalServices\Usercentrics\Tests\Codeception\AcceptanceTester;

final class UsercentricsButtonCest extends BaseCest
{
    /**
     * @param AcceptanceTester $I
     * @throws \Exception
     * @group usercentrics
     */
    public function frontPageWorksAndShowsUserCentricsWallOrBanner(AcceptanceTester $I)
    {
        $homePage = new Home($I);
        $I->amOnPage($homePage->URL);

        $this->waitForUserCentrics($I);
    }
}
