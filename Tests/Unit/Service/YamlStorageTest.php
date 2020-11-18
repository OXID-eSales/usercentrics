<?php

namespace OxidProfessionalServices\Usercentrics\Tests\Service;

use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\TestingLibrary\UnitTestCase;
use org\bovigo\vfs\vfsStream;
use OxidProfessionalServices\Usercentrics\Service\Configuration\StorageInterface;
use OxidProfessionalServices\Usercentrics\Service\Configuration\YamlStorage;

/**
 * YamlStorageTest Yaml
 * @package OxidProfessionalServices\Usercentrics\Tests\Service
 */
class YamlStorageTest extends UnitTestCase
{
    public function testIntegration(): void
    {
        $container = ContainerFactory::getInstance()->getContainer();
        $storage = $container->get(StorageInterface::class);

        $this->assertInstanceOf(YamlStorage::class, $storage);
    }

    public function testGetData(): void
    {
        $baseDir = vfsStream::setup('root', 444);
        $structure = [
            'ConfigReadTest.yaml' => 'test: value'
        ];
        vfsStream::create($structure, $baseDir);

        $sut = new YamlStorage(
            vfsStream::url('root'),
            'ConfigReadTest.yaml'
        );

        $this->assertEquals(["test" => "value"], $sut->getData());
    }

    public function testPutData(): void
    {
        $baseDir = vfsStream::setup('root', 444);
        $structure = [
            'ConfigReadTest.yaml' => 'test: wrongValue'
        ];
        vfsStream::create($structure, $baseDir);

        $sut = new YamlStorage(
            vfsStream::url('root'),
            'ConfigReadTest.yaml'
        );

        $sut->putData(["test" => "correctValue"]);

        $this->assertEquals(["test" => "correctValue"], $sut->getData());
    }
}
