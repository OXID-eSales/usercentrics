<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidProfessionalServices\Usercentrics\Tests\Unit\DataObjects;

use OxidProfessionalServices\Usercentrics\DataObject\ScriptSnippet;
use PHPUnit\Framework\TestCase;

/**
 * Class ServiceTest
 * @package OxidProfessionalServices\Usercentrics\Tests\Unit
 * @covers \OxidProfessionalServices\Usercentrics\DataObject\ScriptSnippet
 */
class ScriptSnippetTest extends TestCase
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
