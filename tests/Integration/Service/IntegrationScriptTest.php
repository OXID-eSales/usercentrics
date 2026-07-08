<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidProfessionalServices\Usercentrics\Tests\Integration\Service;

use OxidProfessionalServices\Usercentrics\Service\Integration\IntegrationScriptBuilderInterface;
use OxidProfessionalServices\Usercentrics\Service\IntegrationScript;
use OxidProfessionalServices\Usercentrics\Service\ModuleSettingsInterface;
use OxidProfessionalServices\Usercentrics\Tests\Unit\UnitTestCase;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Class RendererTest
 */
#[CoversClass(\OxidProfessionalServices\Usercentrics\Service\IntegrationScript::class)]
class IntegrationScriptTest extends UnitTestCase
{
    public function testGetIntegrationScript(): void
    {
        $scriptBuilder = $this->createMock(IntegrationScriptBuilderInterface::class);
        $scriptBuilder
            ->expects($this->once())
            ->method('getIntegrationScript')
            ->with('usercentrics_mode', ['{USERCENTRICS_CLIENT_ID}' => 'usercentrics_id'])
            ->willReturn('integration script');

        $settings = $this->createStub(ModuleSettingsInterface::class);
        $settings->method('getUsercentricsId')->willReturn('usercentrics_id');
        $settings->method('getUsercentricsMode')->willReturn('usercentrics_mode');

        $integrationScript = new IntegrationScript($scriptBuilder, $settings);
        $this->assertEquals('integration script', $integrationScript->getIntegrationScript());
    }
}
