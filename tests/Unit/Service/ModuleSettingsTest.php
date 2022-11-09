<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidProfessionalServices\Usercentrics\Tests\Unit\Service;

use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingService;
use OxidProfessionalServices\Usercentrics\Core\Module;
use OxidProfessionalServices\Usercentrics\Service\ModuleSettings;
use PHPUnit\Framework\TestCase;
use Symfony\Component\String\UnicodeString;

/**
 * @covers \OxidProfessionalServices\Usercentrics\Service\ModuleSettings
 */
class ModuleSettingsTest extends TestCase
{
    /**
     * @dataProvider gettersDataProvider
     */
    public function testGetters($method, $systemMethod, $key, $systemValue, $expectedValue)
    {
        $mssMock = $this->createPartialMock(ModuleSettingService::class, [$systemMethod]);
        $mssMock->expects($this->once())->method($systemMethod)->with(
            $key,
            Module::MODULE_ID
        )->willReturn($systemValue);

        $sut = new ModuleSettings($mssMock);
        $this->assertSame($expectedValue, $sut->$method());
    }

    public function gettersDataProvider(): array
    {
        return [
            $this->prepareStringTestItem('getUsercentricsId', ModuleSettings::USERCENTRICS_ID),
            $this->prepareStringTestItem('getUsercentricsMode', ModuleSettings::USERCENTRICS_MODE),
            $this->prepareStringTestItem('getSmartProtectorBlockingDisabledList', ModuleSettings::USERCENTRICS_SMART_DATA_PROTECTOR_BLOCKING_DISABLED),

            $this->prepareBoolTestItem('isSmartProtectorEnabled', ModuleSettings::USERCENTRICS_SMART_DATA_PROTECTOR_ENABLED, true),
            $this->prepareBoolTestItem('isSmartProtectorEnabled', ModuleSettings::USERCENTRICS_SMART_DATA_PROTECTOR_ENABLED, false),

            $this->prepareBoolTestItem('isDevelopmentAutoConsentEnabled', ModuleSettings::USERCENTRICS_DEVELOPMENT_AUTO_CONSENT, true),
            $this->prepareBoolTestItem('isDevelopmentAutoConsentEnabled', ModuleSettings::USERCENTRICS_DEVELOPMENT_AUTO_CONSENT, false),
        ];
    }

    private function prepareBoolTestItem(string $method, string $key, bool $value): array
    {
        return [
            'method' => $method,
            'systemMethod' => 'getBoolean',
            'key' => $key,
            'systemValue' => $value,
            'expectedValue' => $value
        ];
    }

    private function prepareStringTestItem(string $method, string $key): array
    {
        $exampleValue = 'exampleValue';
        return [
            'method' => $method,
            'systemMethod' => 'getString',
            'key' => $key,
            'systemValue' => new UnicodeString($exampleValue),
            'expectedValue' => $exampleValue
        ];
    }
}