<?php

namespace OxidProfessionalServices\Usercentrics\Tests\Service;

use OxidProfessionalServices\Usercentrics\Service\Configuration\ConfigurationDao;
use OxidProfessionalServices\Usercentrics\Service\Renderer;
use OxidProfessionalServices\Usercentrics\Service\ScriptServiceMapper;
use OxidProfessionalServices\Usercentrics\Service\Configuration\YamlFileFormat;
use OxidProfessionalServices\Usercentrics\Tests\Unit\StorageUnitTestCase;

/**
 * Class RendererTest
 * @package OxidProfessionalServices\Usercentrics\Tests\Service
 * @psalm-suppress PropertyNotSetInConstructor
 */
class RendererTest extends StorageUnitTestCase
{
    public function testWhiteListedScript(): void
    {
        $file = 'Service1.yaml';
        $sut = $this->createRenderer($file);
        $rendered = $sut->formFilesOutput([0 => ["test.js"]], "");

        $this->assertContains('<script src="test.js"></script>', $rendered);
    }

    public function testServiceNamedScript(): void
    {
        $file = 'Service1.yaml';
        $sut = $this->createRenderer($file);
        $rendered = $sut->formFilesOutput([0 => ["test1.js"]], "");

        $this->assertContains(
            '<script type="text/plain" data-usercentrics="name1" src="test1.js"></script>',
            $rendered
        );
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
        $this->assertContains($expectedResult, $rendered);
    }

    private function createRenderer(string $file): Renderer
    {
        $config = new ConfigurationDao($this->getStorage($file, __DIR__ . '/ConfigTestData'));
        $scriptServiceMapper = new ScriptServiceMapper($config);
        return new Renderer($scriptServiceMapper);
    }
}
