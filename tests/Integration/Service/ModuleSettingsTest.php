<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidProfessionalServices\Usercentrics\Tests\Integration\Service;

use OxidEsales\Eshop\Core\Registry;
use OxidEsales\EshopCommunity\Tests\Integration\Internal\ContainerTrait;
use OxidProfessionalServices\Usercentrics\Service\ModuleSettingsInterface;
use OxidProfessionalServices\Usercentrics\Tests\Unit\UnitTestCase;

/**
 * Class RendererTest
 * @covers \OxidProfessionalServices\Usercentrics\Service\ModuleSettings
 */
class ModuleSettingsTest extends UnitTestCase
{
    use ContainerTrait;

    public function testGetSettingValue(): void
    {
        $config = Registry::getConfig();
        $config->saveShopConfVar(
            'str',
            'specialVarName',
            'someValue',
            1,
            'module:oxps_usercentrics'
        );

        /** @var ModuleSettingsInterface $integrationScript */
        $moduleSettings = $this->get(ModuleSettingsInterface::class);
        $value = $moduleSettings->getSettingValue('specialVarName');

        $this->assertEquals('someValue', $value);
    }

    public function testGetSettingValueGivesNullOnMissingSetting(): void
    {
        /** @var ModuleSettingsInterface $integrationScript */
        $moduleSettings = $this->get(ModuleSettingsInterface::class);
        $value = $moduleSettings->getSettingValue('missingSetting');

        $this->assertNull($value);
    }

    public function testGetSettingValueGivesSpecificDefaultOnFail(): void
    {
        /** @var ModuleSettingsInterface $integrationScript */
        $moduleSettings = $this->get(ModuleSettingsInterface::class);
        $value = $moduleSettings->getSettingValue('missingSetting', 'special');

        $this->assertSame('special', $value);
    }
}
