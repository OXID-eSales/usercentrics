<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidProfessionalServices\Usercentrics\Tests\Integration\Core;

use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\ViewConfig as EshopViewConfig;
use OxidProfessionalServices\Usercentrics\Core\Module;
use OxidProfessionalServices\Usercentrics\Core\ViewConfig;
use OxidProfessionalServices\Usercentrics\Service\Integration\Pattern;
use OxidProfessionalServices\Usercentrics\Service\ModuleSettings;
use OxidProfessionalServices\Usercentrics\Tests\Unit\UnitTestCase;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingServiceInterface;
use OxidProfessionalServices\Usercentrics\Traits\ServiceContainer;

/**
 * Class ViewConfigTest
 * @covers \OxidProfessionalServices\Usercentrics\Core\ViewConfig
 */
class ViewConfigTest extends UnitTestCase
{
    use ServiceContainer;

    public function testGetSettings(): void
    {
        $viewConfig = Registry::get(EshopViewConfig::class);
        $this->assertInstanceOf(ModuleSettings::class, $viewConfig->getUsercentricsModuleSettings());
    }

    /**
     * @dataProvider dataProviderTestOutputPerMode
     */
    public function testOutputPerMode(string $mode, string $expected): void
    {
        $settingsService = $this->getServiceFromContainer(ModuleSettingServiceInterface::class);
        $settingsService->saveString(ModuleSettings::USERCENTRICS_MODE, $mode, Module::MODULE_ID);
        $settingsService->saveString(ModuleSettings::USERCENTRICS_ID, 'ABC123', Module::MODULE_ID);

        /** @var ViewConfig $viewConfig */
        $viewConfig = Registry::get(EshopViewConfig::class);
        $html = $viewConfig->getUsercentricsScript();
        $this->assertHtmlEquals($expected, $html);
    }

    public static function dataProviderTestOutputPerMode(): array
    {
        return [
            [
                Pattern\CmpV2Tcf::VERSION_NAME,
                '<script id="usercentrics-cmp"
                    data-settings-id="ABC123"
                    src="https://app.usercentrics.eu/browser-ui/latest/bundle.js"
                    data-tcf-enabled
                    defer></script>'
            ],
            [
                Pattern\CmpV2TcfLegacy::VERSION_NAME,
                '<script id="usercentrics-cmp"
                    data-settings-id="ABC123"
                    src="https://app.usercentrics.eu/browser-ui/latest/bundle_legacy.js"
                    data-tcf-enabled
                    defer></script>'
            ],
            [
                Pattern\CmpV2Legacy::VERSION_NAME,
                '<script id="usercentrics-cmp"
                    data-settings-id="ABC123"
                    src="https://app.usercentrics.eu/browser-ui/latest/bundle_legacy.js"
                    defer></script>'
            ],
            [
                Pattern\CmpV2::VERSION_NAME,
                '<script id="usercentrics-cmp"
                    data-settings-id="ABC123"
                    src="https://app.usercentrics.eu/browser-ui/latest/bundle.js"
                    defer></script>'
            ],
            [
                Pattern\CmpV1::VERSION_NAME,
                '<script type="application/javascript" 
                    src="https://app.usercentrics.eu/latest/main.js" 
                    id="ABC123" ></script>'
            ]
        ];
    }

    public function testNoUsercentricsScriptInCustomMode(): void
    {
        $settingsService = $this->getServiceFromContainer(ModuleSettingServiceInterface::class);
        $settingsService->saveString(ModuleSettings::USERCENTRICS_MODE, Pattern\Custom::VERSION_NAME, Module::MODULE_ID);

        /** @var ViewConfig $viewConfig */
        $viewConfig = Registry::get(EshopViewConfig::class);
        $html = $viewConfig->getUsercentricsScript();
        $this->assertEmpty($html);
    }
}
