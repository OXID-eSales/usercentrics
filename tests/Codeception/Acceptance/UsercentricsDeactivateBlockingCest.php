<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\Tests\Codeception\Acceptance;

use OxidEsales\Codeception\Page\Home;
use OxidProfessionalServices\Usercentrics\Tests\Codeception\Support\AcceptanceTester;
use OxidProfessionalServices\Usercentrics\Tests\Codeception\Module\Config;

final class UsercentricsDeactivateBlockingCest extends BaseCest
{
    public function _before(AcceptanceTester $I, Config $configModule): void
    {
        parent::_before($I, $configModule);

        $I->setSmartDataProtectorActive(true);
        $I->setSmartDataProtectorDeactivateBlocking('xxx , yyy');
    }

    public function _after(AcceptanceTester $I, Config $configModule): void
    {
        parent::_after($I, $configModule);

        $I->setSmartDataProtectorActive(false);
        $I->setSmartDataProtectorDeactivateBlocking('');
    }

    /**
     * @throws \Exception
     * @group usercentrics
     */
    public function protectorBlockingDeactivationConfigurationPresent(AcceptanceTester $I): void
    {
        $homePage = new Home($I);
        $I->amOnPage($homePage->URL);

        $I->seeInSource('<script>uc.deactivateBlocking(["xxx", "yyy"]);</script>');
    }
}
