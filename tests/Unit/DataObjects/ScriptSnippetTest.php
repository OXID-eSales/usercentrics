<?php

namespace OxidProfessionalServices\Usercentrics\Tests\Unit\DataObjects;

use OxidEsales\TestingLibrary\UnitTestCase;
use OxidProfessionalServices\Usercentrics\DataObject\Script;
use OxidProfessionalServices\Usercentrics\DataObject\ScriptSnippet;
use OxidProfessionalServices\Usercentrics\DataObject\Service;

/**
 * Class ServiceTest
 * @package OxidProfessionalServices\Usercentrics\Tests\Unit
 * @covers \OxidProfessionalServices\Usercentrics\DataObject\ScriptSnippet
 */
class ScriptSnippetTest extends UnitTestCase
{
    public function testHasId(): void
    {
        $service = new ScriptSnippet('123ABC', 'testServiceId');
        $this->assertSame('123ABC', $service->getId());
    }

    public function testHasServiceId(): void
    {
        $service = new ScriptSnippet('123ABC', 'testServiceId');
        $this->assertSame('testServiceId', $service->getServiceId());
    }
}
