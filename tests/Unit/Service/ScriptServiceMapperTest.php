<?php

namespace OxidProfessionalServices\Usercentrics\Tests\Service;

use OxidProfessionalServices\Usercentrics\DataObject\Service;
use OxidProfessionalServices\Usercentrics\Service\Configuration\ConfigurationDao;
use OxidProfessionalServices\Usercentrics\Service\ScriptServiceMapper;
use OxidProfessionalServices\Usercentrics\Tests\Unit\StorageUnitTestCase;

/**
 * Class RepositoryTest
 * @package OxidProfessionalServices\Usercentrics\Tests\Service
 * @psalm-suppress PropertyNotSetInConstructor
 */
class ScriptServiceMapperTest extends StorageUnitTestCase
{
    public function testScriptShouldNotBeProcessedIfNotConfigured(): void
    {
        $config = new ConfigurationDao($this->getStorage('EmptyTest.yaml', __DIR__ . '/ConfigTestData'));
        $scriptServiceMapper = new ScriptServiceMapper($config);

        $this->assertFalse(
            $scriptServiceMapper->checkPathShouldBeProcessed("test.js"),
            "test1.js should not be processed as its not configured"
        );
    }

    public function testScriptNameConfigured(): void
    {
        $config = new ConfigurationDao($this->getStorage('Service1.yaml', __DIR__ . '/ConfigTestData'));

        $scriptServiceMapper = new ScriptServiceMapper($config);
        $this->assertTrue(
            $scriptServiceMapper->checkPathShouldBeProcessed("test1.js"),
            "test1.js is marked as no processing needed but it should be processed, as its configured"
        );

        /** @var Service $service */
        $service = $scriptServiceMapper->getScriptPathService("test1.js");

        $this->assertNotNull($service);
        $this->assertEquals("name1", $service->getName());
    }
}
