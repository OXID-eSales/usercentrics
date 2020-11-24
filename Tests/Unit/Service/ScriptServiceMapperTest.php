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
    public function testScriptNoNameConfigured(): void
    {
        $config = new ConfigurationDao($this->getStorage('EmptyTest.yaml', __DIR__ . '/ConfigTestData'));
        $scriptServiceMapper = new ScriptServiceMapper($config);

        $this->assertNull(
            $scriptServiceMapper->getServiceByScriptPath("test.js"),
            "test.js should not return a service name as its not configured"
        );
    }

    public function testScriptNameConfigured(): void
    {
        $config = new ConfigurationDao($this->getStorage('Service1.yaml', __DIR__ . '/ConfigTestData'));

        $scriptServiceMapper = new ScriptServiceMapper($config);

        /** @var Service $service */
        $service = $scriptServiceMapper->getServiceByScriptPath("test1.js");

        $this->assertNotNull($service);
        $this->assertEquals("name1", $service->getName());
    }
}
