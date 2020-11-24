<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

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
        $scriptServiceMapper = $this->createScriptMapper('EmptyTest.yaml');

        $this->assertNull(
            $scriptServiceMapper->getServiceByScriptPath("test.js"),
            "test.js should not return a service name as its not configured"
        );
    }

    public function testScriptNameConfigured(): void
    {
        $scriptServiceMapper = $this->createScriptMapper('Service1.yaml');

        /** @var Service $service */
        $service = $scriptServiceMapper->getServiceByScriptPath("test1.js");

        $this->assertNotNull($service);
        $this->assertEquals("name1", $service->getName());
    }

    public function testCalculateSnippetIdIsNotEmpty(): void
    {
        $scriptServiceMapper = $this->createScriptMapper('Snippets.yaml');
        $snippet = "alert('Service1')";
        $id = $scriptServiceMapper->calculateSnippetId($snippet);
        $this->assertNotEmpty($id);
    }

    public function testCalculateSnippetIdIsUnique(): void
    {
        $scriptServiceMapper = $this->createScriptMapper('Snippets.yaml');
        $snippet = "alert('Service1')";
        $id = $scriptServiceMapper->calculateSnippetId($snippet);

        $snippet2 = "alert('Service2')";
        $id2 = $scriptServiceMapper->calculateSnippetId($snippet2);
        $this->assertNotEquals($id, $id2);
    }

    public function testCalculateSnippetIdIsStable(): void
    {
        $scriptServiceMapper = $this->createScriptMapper('Snippets.yaml');
        $snippet = "alert('Service1')";
        $id = $scriptServiceMapper->calculateSnippetId($snippet);
        $id3 = $scriptServiceMapper->calculateSnippetId($snippet);
        $this->assertEquals($id, $id3);
    }

    public function testGetServiceBySnippetId(): void
    {
        $scriptServiceMapper = $this->createScriptMapper('Snippets.yaml');
        $id = $scriptServiceMapper->calculateSnippetId("alert('Service2')");
        $service = $scriptServiceMapper->getServiceBySnippetId($id);
        $this->assertNotNull($service);
        /** @psalm-suppress PossiblyNullReference */
        $this->assertEquals("name1", $service->getName());
    }

    public function testGetServiceByNotExistingSnippetId(): void
    {
        $scriptServiceMapper = $this->createScriptMapper('Snippets.yaml');
        $id = $scriptServiceMapper->calculateSnippetId("alert('NoService')");
        $service = $scriptServiceMapper->getServiceBySnippetId($id);
        $this->assertNull($service);
    }

    /**
     * @return ScriptServiceMapper
     */
    private function createScriptMapper(string $file): ScriptServiceMapper
    {
        $config = new ConfigurationDao($this->getStorage($file, __DIR__ . '/ConfigTestData'));
        return new ScriptServiceMapper($config);
    }
}
