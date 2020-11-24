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
        $config = new ConfigurationDao($this->getStorage('Service1.yaml', __DIR__ . '/ConfigTestData'));

        $scriptServiceMapper = new ScriptServiceMapper($config);
        $sut = new Renderer($scriptServiceMapper);
        $rendered = $sut->formFilesOutput([0 => ["test.js"]], "");

        $this->assertContains('<script src="test.js"></script>', $rendered);
    }

    public function testServiceNamedScript(): void
    {
        $config = new ConfigurationDao($this->getStorage('Service1.yaml', __DIR__ . '/ConfigTestData'));

        $scriptServiceMapper = new ScriptServiceMapper($config);
        $sut = new Renderer($scriptServiceMapper);
        $rendered = $sut->formFilesOutput([0 => ["test1.js"]], "");

        $this->assertContains(
            '<script type="text/plain" data-usercentrics="name1" src="test1.js"></script>',
            $rendered
        );
    }
}
