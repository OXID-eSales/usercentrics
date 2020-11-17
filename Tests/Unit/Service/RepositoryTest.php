<?php

namespace OxidProfessionalServices\Usercentrics\Tests\Service;

use OxidEsales\TestingLibrary\UnitTestCase;
use OxidProfessionalServices\Usercentrics\Service\ConfigurationAccess;
use OxidProfessionalServices\Usercentrics\Service\Repository;
use OxidProfessionalServices\Usercentrics\Service\YamlFileFormat;

/**
 * Class RepositoryTest
 * @package OxidProfessionalServices\Usercentrics\Tests\Service
 * @psalm-suppress PropertyNotSetInConstructor
 */
class RepositoryTest extends UnitTestCase
{


    public function testScriptIsWhitelistedIfNotConfigured(): void
    {
        $config = new ConfigurationAccess(
            __DIR__ . '/ConfigTestData/EmptyTest.yaml',
            new YamlFileFormat()
        );
        $scriptService = new Repository($config);
        $this->assertTrue($scriptService->isScriptWhitelisted("test.js"));
    }

    public function testScriptNameConfigured(): void
    {
        $config = new ConfigurationAccess(
            __DIR__ . '/ConfigTestData/Service1.yaml',
            new YamlFileFormat()
        );
        $scriptService = new Repository($config);
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
