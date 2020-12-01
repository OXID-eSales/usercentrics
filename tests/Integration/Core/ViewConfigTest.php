<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidProfessionalServices\Usercentrics\Tests\Integration\Core;

use OxidEsales\Eshop\Core\Registry;
use OxidProfessionalServices\Usercentrics\Core\ViewConfig;
use PHPUnit\Framework\TestCase;

/**
 * Class ViewConfigTest
 * @package OxidProfessionalServices\Usercentrics\Tests\Integration\Core
 * @covers \OxidProfessionalServices\Usercentrics\Core\ViewConfig
 */
class ViewConfigTest extends TestCase
{
    /**
     * @dataProvider booleanProvider
     */
    public function testSmartDataProtectorActive(bool $setting): void
    {
        $config = Registry::getConfig();
        /** @psalm-suppress InvalidScalarArgument fails because of wrong typehin in used oxid version */
        $config->setConfigParam("smartDataProtectorActive", $setting);

        /** @var ViewConfig $viewConfig */
        $viewConfig = Registry::get(\OxidEsales\Eshop\Core\ViewConfig::class);
        // $this->assertInstanceOf(JavaScriptRenderer::class, $viewConfig);
        $enabled = $viewConfig->isSmartDataProtectorActive();
        $this->assertSame($setting, $enabled);
    }

    public function booleanProvider(): array
    {
        return [
            [true],
            [false]
        ];
    }
}
