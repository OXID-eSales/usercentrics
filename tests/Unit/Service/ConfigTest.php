<?php

namespace OxidProfessionalServices\Usercentrics\Tests\Unit\Service;

use OxidProfessionalServices\Usercentrics\DataObject\ScriptSnippet;
use OxidProfessionalServices\Usercentrics\Service\Configuration\ConfigurationDao;
use OxidProfessionalServices\Usercentrics\DataObject\Configuration;
use OxidProfessionalServices\Usercentrics\DataObject\Script;
use OxidProfessionalServices\Usercentrics\DataObject\Service;
use OxidProfessionalServices\Usercentrics\Tests\Unit\StorageUnitTestCase;

/**
 * Class ConfigTest
 * @package OxidProfessionalServices\Usercentrics\Tests\Service
 * @psalm-suppress PropertyNotSetInConstructor
 */
class ConfigTest extends StorageUnitTestCase
{
    public function testConfigPut(): void
    {
        $directory = $this->getVirtualStructurePath();
        $file = 'ConfigPutTest.yaml';

        $sut = new ConfigurationDao($this->getStorage($file, $directory));

        $scripts = [new Script('test.js', 'TestServiceId')];
        $services = [new Service('name', 'TestServiceId')];
        $snippets = [new ScriptSnippet('123', 'TestServiceId')];
        $configuration = new Configuration($scripts, $services, $snippets);

        $sut->putConfiguration($configuration);

        $this->assertFileEquals(
            __DIR__ . '/ConfigTestData/ConfigPutTest.yaml',
            $directory . DIRECTORY_SEPARATOR . $file
        );
    }

    public function testConfigGet(): void
    {
        $file = 'ConfigReadTest.yaml';

        $sut = new ConfigurationDao($this->getStorage($file, __DIR__ . '/ConfigTestData/'));

        $configuration = $sut->getConfiguration();

        $oneService = $configuration->getServices()['TestService1Id'];
        $this->assertEquals("TestService1Id", $oneService->getId());
        $this->assertEquals("name1", $oneService->getName());

        $oneScript = $configuration->getScripts()[0];
        $this->assertEquals("test1.js", $oneScript->getPath());
        $this->assertEquals("TestService1Id", $oneScript->getServiceId());
    }
}
