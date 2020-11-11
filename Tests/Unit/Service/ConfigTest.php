<?php

namespace OxidProfessionalServices\Usercentrics\Tests\Service;

use org\bovigo\vfs\vfsStream;
use OxidEsales\TestingLibrary\UnitTestCase;
use OxidProfessionalServices\Usercentrics\Service\ConfigurationAccess;
use OxidProfessionalServices\Usercentrics\DataObject\Configuration;
use OxidProfessionalServices\Usercentrics\DataObject\Script;
use OxidProfessionalServices\Usercentrics\DataObject\Service;
use OxidProfessionalServices\Usercentrics\Service\Yaml;

/**
 * Class ConfigTest
 * @package OxidProfessionalServices\Usercentrics\Tests\Service
 * @psalm-suppress PropertyNotSetInConstructor
 */
class ConfigTest extends UnitTestCase
{
    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function testConfigPut(): void
    {
        // setup and cache the virtual file system
        $fileSystem = vfsStream::setup('root', 444);


        $targetConfigFilePath = $fileSystem->url() . "/ConfigPutTest.yaml";
        $sut = new ConfigurationAccess($targetConfigFilePath, new Yaml());
        $scripts = [new Script("test.js", "TestServiceId")];
        $services = [new Service("name", "TestServiceId")];
        $configuration = new Configuration($scripts, $services);
        $sut->putConfiguration($configuration);
        $this->assertFileExists($targetConfigFilePath);
        $this->assertFileEquals(__DIR__ . "/ConfigTestData/ConfigPutTest.yaml", $targetConfigFilePath);
    }

    public function testConfigGet(): void
    {
        $sut = new ConfigurationAccess(__DIR__ . "/ConfigTestData/ConfigReadTest.yaml", new Yaml());
        $configuration = $sut->getConfiguration();
        $this->assertEquals("TestService1Id", $configuration->getServices()[0]->getId());
        $this->assertEquals("name1", $configuration->getServices()[0]->getName());
        $this->assertEquals("test1.js", $configuration->getScripts()[0]->getPath());
        $this->assertEquals("TestService1Id", $configuration->getScripts()[0]->getServiceId());
    }
}
