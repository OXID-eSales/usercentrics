<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidProfessionalServices\Usercentrics\Tests\Integration\Core;

use DOMDocument;
use OxidEsales\Eshop\Core\Registry;
use OxidProfessionalServices\Usercentrics\Core\ViewConfig;
use OxidProfessionalServices\Usercentrics\Service\IntegrationMode\IntegrationModeFactory;

/**
 * Class ViewConfigTest
 * @package OxidProfessionalServices\Usercentrics\Tests\Integration\Core
 * @covers \OxidProfessionalServices\Usercentrics\Core\ViewConfig
 */
class ViewConfigTest extends \OxidEsales\TestingLibrary\UnitTestCase
{
    /**
     * @dataProvider booleanProvider
     */
    public function testSmartDataProtectorActive(bool $setting): void
    {
        $config = Registry::getConfig();
        /** @psalm-suppress InvalidScalarArgument fails because of wrong typehint in used oxid version */
        $config->setConfigParam("smartDataProtectorActive", $setting);

        /** @var ViewConfig $viewConfig */
        $viewConfig = Registry::get(\OxidEsales\Eshop\Core\ViewConfig::class);
        // $this->assertInstanceOf(JavaScriptRenderer::class, $viewConfig);
        $enabled = $viewConfig->isSmartDataProtectorActive();
        $this->assertSame($setting, $enabled);
    }

    /**
     * @dataProvider modeProvider
     */
    public function testOutputPerMode(string $mode, string $expected): void
    {
        $config = Registry::getConfig();

        /** @psalm-suppress InvalidScalarArgument fails because of wrong typehint in used oxid version */
        $config->saveShopConfVar('string', 'usercentricsMode', $mode, 1, 'module:oxps_usercentrics');
        $config->saveShopConfVar('string', 'usercentricsId', 'ABC123', 1, 'module:oxps_usercentrics');

        /** @var ViewConfig $viewConfig */
        $viewConfig = Registry::get(\OxidEsales\Eshop\Core\ViewConfig::class);
        $html = $viewConfig->getUsercentricsScript();
        $this->assertHtmlEquals($expected, $html);
    }

    public function modeProvider(): array
    {
        return [
            [IntegrationModeFactory::MODE_CMPV2_TCF, '<script id="usercentrics-cmp"
                                data-settings-id="ABC123"
                                src="https://app.usercentrics.eu/browser-ui/latest/bundle.js"
                                data-tcf-enabled
                                defer></script>'],
            [IntegrationModeFactory::MODE_CMPV2_TCF_LEGACY, '<script id="usercentrics-cmp"
                                data-settings-id="ABC123"
                                src="https://app.usercentrics.eu/browser-ui/latest/bundle_legacy.js"
                                data-tcf-enabled
                                defer></script>'],
            [IntegrationModeFactory::MODE_CMPV2_LEGACY, '<script id="usercentrics-cmp"
                                data-settings-id="ABC123"
                                src="https://app.usercentrics.eu/browser-ui/latest/bundle_legacy.js"
                                defer></script>'],
            [IntegrationModeFactory::MODE_CMPV2, '<script id="usercentrics-cmp"
                                data-settings-id="ABC123"
                                src="https://app.usercentrics.eu/browser-ui/latest/bundle.js"
                                defer></script>'],
            [IntegrationModeFactory::MODE_CMPV1, '<script type="application/javascript" 
                        src="https://app.usercentrics.eu/latest/main.js" 
                        id="ABC123" ></script>'],
        ];
    }

    public function assertHtmlEquals(string $expected, string $actual): void
    {
        $eDom = new DOMDocument();
        $eDom->loadHTML($expected, LIBXML_HTML_NOIMPLIED);
        $aDom = new DOMDocument();
        $aDom->loadHTML($actual, LIBXML_HTML_NOIMPLIED);
        $this->assertXmlStringEqualsXmlString($eDom, $aDom);
    }

    public function testNoUsercentricsScriptInCustomMode(): void
    {
        $config = Registry::getConfig();
        /** @psalm-suppress InvalidScalarArgument fails because of wrong typehint in used oxid version */
        $config->saveShopConfVar('string', 'usercentricsMode', IntegrationModeFactory::MODE_CUSTOM, 1, 'module:oxps_usercentrics');

        /** @var ViewConfig $viewConfig */
        $viewConfig = Registry::get(\OxidEsales\Eshop\Core\ViewConfig::class);
        $html = $viewConfig->getUsercentricsScript();
        $this->assertEmpty($html);
    }


    /**
     * @psalm-return list<list<string>>
     * @return array<string[]>
     */
    public function modesWithSettingsId(): array
    {
        return [
            [IntegrationModeFactory::MODE_CMPV1],
            [IntegrationModeFactory::MODE_CMPV2],
            [IntegrationModeFactory::MODE_CMPV2_LEGACY],
            [IntegrationModeFactory::MODE_CMPV2_TCF],
            [IntegrationModeFactory::MODE_CMPV2_TCF_LEGACY]
            ];
    }


    public function booleanProvider(): array
    {
        return [
            [true],
            [false]
        ];
    }
}
