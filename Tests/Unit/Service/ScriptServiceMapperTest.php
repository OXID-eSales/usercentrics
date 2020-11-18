<?php

namespace OxidProfessionalServices\Usercentrics\Tests\Service;

use OxidProfessionalServices\Usercentrics\Service\Configuration\ConfigurationDao;
use OxidProfessionalServices\Usercentrics\Service\ScriptServiceMapper;
use OxidProfessionalServices\Usercentrics\Service\Configuration\YamlFileFormat;
use OxidProfessionalServices\Usercentrics\Tests\Unit\StorageUnitTestCase;

/**
 * Class RepositoryTest
 * @package OxidProfessionalServices\Usercentrics\Tests\Service
 * @psalm-suppress PropertyNotSetInConstructor
 */
class ScriptServiceMapperTest extends StorageUnitTestCase
{
    public function testScriptIsWhitelistedIfNotConfigured(): void
    {
        $config = new ConfigurationDao($this->getStorage('EmptyTest.yaml', __DIR__ . '/ConfigTestData'));

        $scriptServiceMapper = new ScriptServiceMapper($config);
        $this->assertTrue($scriptServiceMapper->isScriptWhitelisted("test.js"));
    }

    public function testScriptNameConfigured(): void
    {
        $config = new ConfigurationDao($this->getStorage('Service1.yaml', __DIR__ . '/ConfigTestData'));

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
