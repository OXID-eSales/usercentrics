<?php

namespace OxidProfessionalServices\Usercentrics\Tests\Service;

use OxidEsales\TestingLibrary\UnitTestCase;
use OxidProfessionalServices\Usercentrics\Service\UsercentricsConfigurationAccess;
use OxidProfessionalServices\Usercentrics\Service\UsercentricsScript;
use OxidProfessionalServices\Usercentrics\Service\Yaml;

/**
 * Class UsercentricsScriptTest
 * @package OxidProfessionalServices\Usercentrics\Tests\Service
 * @psalm-suppress PropertyNotSetInConstructor
 */
class UsercentricsScriptTest extends UnitTestCase
{


    public function testScriptIsWhitelistedIfNotConfigured(): void
    {
        $config = new UsercentricsConfigurationAccess(
            __DIR__ . '/ConfigTestData/EmptyTest.yaml',
            new Yaml()
        );
        $scriptService = new UsercentricsScript($config);
        $this->assertTrue($scriptService->isScriptWhitelisted("test.js"));
    }

    public function testScriptNameConfigured(): void
    {
        $config = new UsercentricsConfigurationAccess(
            __DIR__ . '/ConfigTestData/Service1.yaml',
            new Yaml()
        );
        $scriptService = new UsercentricsScript($config);
        $this->assertFalse(
            $scriptService->isScriptWhitelisted("test1.js"),
            "test1.js whitelisted but configured"
        );
        $service = $scriptService->scriptService("test1.js");
        $this->assertNotNull($service);
        assert($service != null);
        $this->assertEquals("name1", $service->getName());
    }
}
