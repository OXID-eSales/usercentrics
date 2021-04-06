<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidProfessionalServices\Usercentrics\Tests\Integration\Service;

use OxidProfessionalServices\Usercentrics\Exception\WidgetsNotSupported;
use OxidProfessionalServices\Usercentrics\Service\Configuration\ConfigurationDao;
use OxidProfessionalServices\Usercentrics\Service\Renderer;
use OxidProfessionalServices\Usercentrics\Service\ScriptServiceMapper;
use OxidProfessionalServices\Usercentrics\Tests\Unit\UnitTestCase;

/**
 * Class RendererTest
 * @package OxidProfessionalServices\Usercentrics\Tests\Integration\Service
 * @psalm-suppress PropertyNotSetInConstructor
 * @covers \OxidProfessionalServices\Usercentrics\Service\Renderer
 */
class RendererTest extends UnitTestCase
{
    public function testWhiteListedScript(): void
    {
        $file = 'Service1.yaml';
        $sut = $this->createRenderer($file);
        $rendered = $sut->formFilesOutput([0 => ["http://shop.de/out/theme/js/test.js"]], "");

        $this->doAssertStringContainsString('<script type="text/javascript" src="http://shop.de/out/theme/js/test.js"></script>', $rendered);
    }

    public function testServiceNamedScript(): void
    {
        $file = 'Service1.yaml';
        $sut = $this->createRenderer($file);
        $rendered = $sut->formFilesOutput([0 => ["https://shop.de/out/theme/js/test1.js"]], "");

        $this->doAssertStringContainsString(
            '<script type="text/plain" data-usercentrics="name1" src="https://shop.de/out/theme/js/test1.js"></script>',
            $rendered
        );
    }

    public function testNoScript(): void
    {
        $file = 'Service1.yaml';
        $sut = $this->createRenderer($file);
        $rendered = $sut->formFilesOutput([], "");

        $this->assertEmpty($rendered);
    }

    public function testServiceNamedSnippet(): void
    {
        $file = 'Snippets.yaml';
        $sut = $this->createRenderer($file);
        $rendered = $sut->encloseScriptSnippet("alert('Service2')", "", false);

        $expectedResult = <<<'HTML'
<script type="text/plain" data-usercentrics="name1" data-oxid="7bfef2a19ce3ab042f05792ac47bca23">
alert('Service2')
</script>
HTML;
        $expectedResult = str_replace("\n", '', $expectedResult);
        $this->doAssertStringContainsString($expectedResult, $rendered);
    }

    public function testNoSnippet(): void
    {
        $file = 'Snippets.yaml';
        $sut = $this->createRenderer($file);
        $rendered = $sut->encloseScriptSnippet("", "", false);

        $this->assertEmpty($rendered);
    }

    public function testFormFilesOutputDoesNotSupportWidgets(): void
    {
        $this->expectException(WidgetsNotSupported::class);

        $file = 'Snippets.yaml';
        $sut = $this->createRenderer($file);
        $sut->formFilesOutput([], "widgetName");
    }

    public function testEncloseScriptSnippetDoesNotSupportWidgets(): void
    {
        $this->expectException(WidgetsNotSupported::class);

        $file = 'Snippets.yaml';
        $sut = $this->createRenderer($file);
        $sut->encloseScriptSnippet("", "widgetName", false);
    }

    protected function createRenderer(string $file): Renderer
    {
        $config = new ConfigurationDao($this->getStorage($file, __DIR__ . '/ConfigTestData'));
        $scriptServiceMapper = new ScriptServiceMapper($config);
        return new Renderer($scriptServiceMapper);
    }

    /**
     * @param string $needle
     * @param string $haystack
     * @param string $message
     */
    protected function doAssertStringContainsString($needle, $haystack, $message = ''): void
    {
        if (method_exists($this, 'assertStringContainsString')) {
            parent::assertStringContainsString($needle, $haystack, $message);
        } else {
            parent::assertContains($needle, $haystack, $message);
        }
    }
}
