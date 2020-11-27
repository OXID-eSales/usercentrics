<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\Tests\Unit\Service;

use OxidEsales\Eshop\Core\Registry;
use OxidProfessionalServices\Usercentrics\Core\ViewConfig;
use PHPUnit\Framework\TestCase;

/**
 * Class ExampleTest
 * @covers \OxidProfessionalServices\Usercentrics\Core\ViewConfig
 */
class ViewConfigTest extends TestCase
{
    public function testSmartDataProtectorActiveByDefault(): void
    {
        /** @var ViewConfig $viewConfig */
        $viewConfig = Registry::get(\OxidEsales\Eshop\Core\ViewConfig::class);
       // $this->assertInstanceOf(JavaScriptRenderer::class, $viewConfig);
        $enabled = $viewConfig->isSmartDataProtectorActive();
        $this->assertTrue($enabled);
    }
}
