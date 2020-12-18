<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidProfessionalServices\Usercentrics\Tests\Integration\Service;

use OxidProfessionalServices\Usercentrics\DataObject\ScriptSnippet;
use OxidProfessionalServices\Usercentrics\Service\Configuration\ConfigurationDao;
use OxidProfessionalServices\Usercentrics\DataObject\Configuration;
use OxidProfessionalServices\Usercentrics\DataObject\Script;
use OxidProfessionalServices\Usercentrics\DataObject\Service;
use OxidProfessionalServices\Usercentrics\Tests\Unit\UnitTestCase;

/**
 * Class ConfigTest
 * @package OxidProfessionalServices\Usercentrics\Tests\Integration\Service
 * @psalm-suppress PropertyNotSetInConstructor
 * @covers \OxidProfessionalServices\Usercentrics\Service\Configuration\ConfigurationDao
 */
class ConfigTest extends UnitTestCase
{
    public function testConfigPut(): void
    {
        $directory = $this->getVirtualStructurePath();
        $file = 'ConfigPutTest.yaml';

        $sut = new ConfigurationDao($this->getStorage($file, $directory));

        $services = [new Service('name', 'TestServiceId')];
        $scripts = [new Script('test.js', 'TestServiceId')];
        $snippets = [new ScriptSnippet('123', 'TestServiceId')];
        $configuration = new Configuration($services, $scripts, $snippets);

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
