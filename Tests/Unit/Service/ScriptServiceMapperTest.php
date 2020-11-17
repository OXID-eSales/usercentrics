<?php

namespace OxidProfessionalServices\Usercentrics\Tests\Service;

use OxidEsales\TestingLibrary\UnitTestCase;
use OxidProfessionalServices\Usercentrics\Service\Configuration\ConfigurationDao;
use OxidProfessionalServices\Usercentrics\Service\ScriptServiceMapper;
use OxidProfessionalServices\Usercentrics\Service\Configuration\YamlFileFormat;

/**
 * Class RepositoryTest
 * @package OxidProfessionalServices\Usercentrics\Tests\Service
 * @psalm-suppress PropertyNotSetInConstructor
 */
class RepositoryTest extends UnitTestCase
{


    public function testScriptIsWhitelistedIfNotConfigured(): void
    {
        $config = new ConfigurationDao(
            __DIR__ . '/ConfigTestData/EmptyTest.yaml',
            new YamlFileFormat()
        );
        $scriptServiceMapper = new ScriptServiceMapper($config);
        $this->assertTrue($scriptServiceMapper->isScriptWhitelisted("test.js"));
    }

    public function testScriptNameConfigured(): void
    {
        $config = new ConfigurationDao(
            __DIR__ . '/ConfigTestData/Service1.yaml',
            new YamlFileFormat()
        );
        $scriptServiceMapper = new ScriptServiceMapper($config);
        $this->assertFalse(
            $scriptServiceMapper->isScriptWhitelisted("test1.js"),
            "test1.js whitelisted but configured"
        );
        $service = $scriptServiceMapper->scriptService("test1.js");
        $this->assertNotNull($service);
        assert($service != null);
        $this->assertEquals("name1", $service->getName());
    }
}
