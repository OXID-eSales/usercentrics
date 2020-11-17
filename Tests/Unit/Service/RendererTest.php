<?php

namespace OxidProfessionalServices\Usercentrics\Tests\Service;

use OxidEsales\TestingLibrary\UnitTestCase;
use OxidProfessionalServices\Usercentrics\Service\ConfigurationAccess;
use OxidProfessionalServices\Usercentrics\Service\Renderer;
use OxidProfessionalServices\Usercentrics\Service\Repository;
use OxidProfessionalServices\Usercentrics\Service\YamlFileFormat;

/**
 * Class RendererTest
 * @package OxidProfessionalServices\Usercentrics\Tests\Service
 * @psalm-suppress PropertyNotSetInConstructor
 */
class RendererTest extends UnitTestCase
{


    public function testWhiteListedScript(): void
    {
        $config = new ConfigurationAccess(
            __DIR__ . '/ConfigTestData/Service1.yaml',
            new YamlFileFormat()
        );
        $repository = new Repository($config);
        $sut = new Renderer($repository);
        $rendered = $sut->formFilesOutput([0 => ["test.js"]], "");
        $this->assertContains('<script src="test.js"></script>', $rendered);
    }

    public function testServiceNamedScript(): void
    {
        $config = new ConfigurationAccess(
            __DIR__ . '/ConfigTestData/Service1.yaml',
            new YamlFileFormat()
        );
        $repository = new Repository($config);
        $sut = new Renderer($repository);
        $rendered = $sut->formFilesOutput([0 => ["test1.js"]], "");
        $this->assertContains(
            '<script type="text/plain" data-usercentrics="name1" src="test1.js"></script>',
            $rendered
        );
    }
}
