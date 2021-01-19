<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidProfessionalServices\Usercentrics\Tests\Integration\Service;

use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidProfessionalServices\Usercentrics\Service\Configuration\StorageInterface;
use OxidProfessionalServices\Usercentrics\Service\Configuration\YamlStorage;
use OxidProfessionalServices\Usercentrics\Tests\Unit\UnitTestCase;

/**
 * YamlStorageTest Yaml
 * @package OxidProfessionalServices\Usercentrics\Tests\Integration\Service
 * @covers \OxidProfessionalServices\Usercentrics\Service\Configuration\YamlStorage
 */
class YamlStorageTest extends UnitTestCase
{
    public function testIntegration(): void
    {
        $container = ContainerFactory::getInstance()->getContainer();
        /** @var StorageInterface $storage */
        $storage = $container->get(StorageInterface::class);

        $this->assertInstanceOf(YamlStorage::class, $storage);
    }

    public function testGetData(): void
    {
        $path = $this->getVirtualStructurePath([
            'ConfigReadTest.yaml' => 'test: value'
        ]);

        $sut = new YamlStorage(
            $path,
            'ConfigReadTest.yaml'
        );

        $this->assertEquals(["test" => "value"], $sut->getData());
    }

    public function testGetNotExistingFileDataGivesEmptyArray(): void
    {
        $path = $this->getVirtualStructurePath([]);
        $file = 'ConfigReadTest.yaml';

        $sut = new YamlStorage(
            $path,
            'ConfigReadTest.yaml'
        );

        $this->assertFileNotExists($path . DIRECTORY_SEPARATOR . $file);

        $this->assertEquals([], $sut->getData());
    }

    public function testPutData(): void
    {
        $path = $this->getVirtualStructurePath([
            'ConfigReadTest.yaml' => 'test: wrongValue'
        ]);

        $sut = new YamlStorage(
            $path,
            'ConfigReadTest.yaml'
        );

        $sut->putData(["test" => "correctValue"]);

        $this->assertEquals(["test" => "correctValue"], $sut->getData());
    }
}
