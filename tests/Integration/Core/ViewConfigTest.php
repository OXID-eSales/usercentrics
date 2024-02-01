<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidProfessionalServices\Usercentrics\Tests\Integration\Core;

use OxidProfessionalServices\Usercentrics\Core\ViewConfig;
use OxidProfessionalServices\Usercentrics\Service\IntegrationScriptInterface;
use OxidProfessionalServices\Usercentrics\Service\ModuleSettingsInterface;
use OxidProfessionalServices\Usercentrics\Tests\Unit\UnitTestCase;

/**
 * Class ViewConfigTest
 * @covers \OxidProfessionalServices\Usercentrics\Core\ViewConfig
 */
class ViewConfigTest extends UnitTestCase
{
    public function testGetUsercentricsModuleSettings(): void
    {
        $settingsStub = $this->createStub(ModuleSettingsInterface::class);

        $viewConfig = $this->createPartialMock(ViewConfig::class, ['getService']);
        $viewConfig
            ->method('getService')
            ->with(ModuleSettingsInterface::class)
            ->willReturn($settingsStub);

        $this->assertSame($settingsStub, $viewConfig->getUsercentricsModuleSettings());
    }

    public function testGetUsercentricsScript(): void
    {
        $script = $this->createMock(IntegrationScriptInterface::class);
        $script
            ->method('getIntegrationScript')
            ->willReturn('script content');

        $viewConfig = $this->createPartialMock(ViewConfig::class, ['getService']);
        $viewConfig
            ->method('getService')
            ->with(IntegrationScriptInterface::class)
            ->willReturn($script);

        $this->assertEquals('script content', $viewConfig->getUsercentricsScript());
    }
}
