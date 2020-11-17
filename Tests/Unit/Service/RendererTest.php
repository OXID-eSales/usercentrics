<?php

namespace OxidProfessionalServices\Usercentrics\Tests\Service;

use OxidEsales\TestingLibrary\UnitTestCase;
use OxidProfessionalServices\Usercentrics\Service\Configuration\ConfigurationDao;
use OxidProfessionalServices\Usercentrics\Service\Renderer;
use OxidProfessionalServices\Usercentrics\Service\ScriptServiceMapper;
use OxidProfessionalServices\Usercentrics\Service\Configuration\YamlFileFormat;

/**
 * Class RendererTest
 * @package OxidProfessionalServices\Usercentrics\Tests\Service
 * @psalm-suppress PropertyNotSetInConstructor
 */
class RendererTest extends UnitTestCase
{


    public function testWhiteListedScript(): void
    {
        $config = new ConfigurationDao(
            __DIR__ . '/ConfigTestData/Service1.yaml',
            new YamlFileFormat()
        );
        $scriptServiceMapper = new ScriptServiceMapper($config);
        $sut = new Renderer($scriptServiceMapper);
        $rendered = $sut->formFilesOutput([0 => ["test.js"]], "");
        $this->assertContains('<script src="test.js"></script>', $rendered);
    }

    public function testServiceNamedScript(): void
    {
        $config = new ConfigurationDao(
            __DIR__ . '/ConfigTestData/Service1.yaml',
            new YamlFileFormat()
        );
        $scriptServiceMapper = new ScriptServiceMapper($config);
        $sut = new Renderer($scriptServiceMapper);
        $rendered = $sut->formFilesOutput([0 => ["test1.js"]], "");
        $this->assertContains(
            '<script type="text/plain" data-usercentrics="name1" src="test1.js"></script>',
            $rendered
        );
    }
}
