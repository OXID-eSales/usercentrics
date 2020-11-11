<?php

namespace OxidProfessionalServices\Usercentrics\Tests\Service;

use OxidEsales\TestingLibrary\UnitTestCase;
use OxidProfessionalServices\Usercentrics\Service\UsercentricsConfigurationAccess;
use OxidProfessionalServices\Usercentrics\Service\UsercentricsRenderer;
use OxidProfessionalServices\Usercentrics\Service\UsercentricsScript;
use OxidProfessionalServices\Usercentrics\Service\Yaml;

/**
 * Class UsercentricsRendererTest
 * @package OxidProfessionalServices\Usercentrics\Tests\Service
 * @psalm-suppress PropertyNotSetInConstructor
 */
class UsercentricsRendererTest extends UnitTestCase
{


    public function testWhiteListedScript(): void
    {
        $config = new UsercentricsConfigurationAccess(
            __DIR__ . '/ConfigTestData/Service1.yaml',
            new Yaml()
        );
        $repository = new UsercentricsScript($config);
        $sut = new UsercentricsRenderer($repository);
        $rendered = $sut->formFilesOutput([0 => ["test.js"]], "");
        $this->assertContains('<script src="test.js"></script>', $rendered);
    }

    public function testServiceNamedScript(): void
    {
        $config = new UsercentricsConfigurationAccess(
            __DIR__ . '/ConfigTestData/Service1.yaml',
            new Yaml()
        );
        $repository = new UsercentricsScript($config);
        $sut = new UsercentricsRenderer($repository);
        $rendered = $sut->formFilesOutput([0 => ["test1.js"]], "");
        $this->assertContains(
            '<script type="text/plain" data-usercentrics="name1" src="test1.js"></script>',
            $rendered
        );
    }
}
