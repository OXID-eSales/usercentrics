<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidProfessionalServices\Usercentrics\Tests\Integration\Core;

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
     * @dataProvider modesWithSettingsId
     * @param $mode
     */
    public function testUsercentricsScriptIncludesId(string $mode): void
    {
        $config = Registry::getConfig();
        /** @psalm-suppress InvalidScalarArgument fails because of wrong typehint in used oxid version */
        $config->setConfigParam("usercentricsMode", $mode);
        $config->setConfigParam("usercentricsId", 'ABC123');
        /** @var ViewConfig $viewConfig */
        $viewConfig = Registry::get(\OxidEsales\Eshop\Core\ViewConfig::class);
        $html = $viewConfig->getUsercentricsScript();
        $condition = preg_match('/.*[\- ]id="ABC123".*/', $html) === 1;
        $this->assertTrue($condition, "script does not contain ID");
    }

    public function testNoUsercentricsScriptInCustomMode(): void
    {
        $config = Registry::getConfig();
        /** @psalm-suppress InvalidScalarArgument fails because of wrong typehint in used oxid version */
        $config->setConfigParam("usercentricsMode", IntegrationModeFactory::MODE_CUSTOM);
        /** @var ViewConfig $viewConfig */
        $viewConfig = Registry::get(\OxidEsales\Eshop\Core\ViewConfig::class);
        $html = $viewConfig->getUsercentricsScript();
        $this->assertEmpty($html);
    }

    public function testCmpV1Format(): void
    {
        $config = Registry::getConfig();
        /** @psalm-suppress InvalidScalarArgument fails because of wrong typehint in used oxid version */
        $config->setConfigParam("usercentricsMode", IntegrationModeFactory::MODE_CMPV1);
        $config->setConfigParam("usercentricsId", 'ABC123');
        $viewConfig = Registry::get(\OxidEsales\Eshop\Core\ViewConfig::class);
        $html = $viewConfig->getUsercentricsScript();
        $this->assertHtmlEquals(
            '<script type="application/javascript" src="https://app.usercentrics.eu/latest/main.js" 
                        id="ABC123" ></script>',
            $html
        );
    }
    public function testCmpV2Format(): void
    {
        $config = Registry::getConfig();
        /** @psalm-suppress InvalidScalarArgument fails because of wrong typehint in used oxid version */
        $config->setConfigParam("usercentricsMode", IntegrationModeFactory::MODE_CMPV2);
        $config->setConfigParam("usercentricsId", 'ABC123');
        $viewConfig = Registry::get(\OxidEsales\Eshop\Core\ViewConfig::class);
        $html = $viewConfig->getUsercentricsScript();
        $this->assertHtmlEquals(
            '<script id="usercentrics-cmp"
                                data-settings-id="ABC123"
                                src="https://app.usercentrics.eu/browser-ui/latest/bundle.js"
                                defer></script>',
            $html
        );
    }
    public function testCmpV2LegacyFormat(): void
    {
        $config = Registry::getConfig();
        /** @psalm-suppress InvalidScalarArgument fails because of wrong typehint in used oxid version */
        $config->setConfigParam("usercentricsMode", IntegrationModeFactory::MODE_CMPV2_LEGACY);
        $config->setConfigParam("usercentricsId", 'ABC123');
        $viewConfig = Registry::get(\OxidEsales\Eshop\Core\ViewConfig::class);
        $html = $viewConfig->getUsercentricsScript();
        $this->assertHtmlEquals(
            '<script id="usercentrics-cmp"
                                data-settings-id="ABC123"
                                src="https://app.usercentrics.eu/browser-ui/latest/bundle_legacy.js"
                                defer></script>',
            $html
        );
    }
    public function testCmpTfcLegacyFormat(): void
    {
        $config = Registry::getConfig();
        /** @psalm-suppress InvalidScalarArgument fails because of wrong typehint in used oxid version */
        $config->setConfigParam("usercentricsMode", IntegrationModeFactory::MODE_CMPV2_TCF_LEGACY);
        $config->setConfigParam("usercentricsId", 'ABC123');
        $viewConfig = Registry::get(\OxidEsales\Eshop\Core\ViewConfig::class);
        $html = $viewConfig->getUsercentricsScript();
        $this->assertHtmlEquals(
            '<script id="usercentrics-cmp"
                                data-settings-id="ABC123"
                                src="https://app.usercentrics.eu/browser-ui/latest/bundle_legacy.js"
                                data-tcf-enabled
                                defer></script>',
            $html
        );
    }
    public function testCmpTfcFormat(): void
    {
        $config = Registry::getConfig();
        /** @psalm-suppress InvalidScalarArgument fails because of wrong typehint in used oxid version */
        $config->setConfigParam("usercentricsMode", IntegrationModeFactory::MODE_CMPV2_TCF);
        $config->setConfigParam("usercentricsId", 'ABC123');
        $viewConfig = Registry::get(\OxidEsales\Eshop\Core\ViewConfig::class);
        $html = $viewConfig->getUsercentricsScript();
        $this->assertHtmlEquals(
            '<script id="usercentrics-cmp"
                                data-settings-id="ABC123"
                                src="https://app.usercentrics.eu/browser-ui/latest/bundle.js"
                                data-tcf-enabled
                                defer></script>',
            $html
        );
    }

    public function assertHtmlEquals(string $expected, string $actual): void
    {
        /** @var \DOMDocument $eDom */
        $eDom = \DOMDocument::loadHTML($expected, LIBXML_HTML_NOIMPLIED);
        /** @var \DOMDocument $aDom */
        $aDom = \DOMDocument::loadHTML($actual, LIBXML_HTML_NOIMPLIED);
        $this->assertXmlStringEqualsXmlString($eDom, $aDom);
    }


    public function modesWithSettingsId()
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
