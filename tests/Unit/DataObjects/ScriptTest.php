<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidProfessionalServices\Usercentrics\Tests\Unit\DataObjects;

use OxidProfessionalServices\Usercentrics\DataObject\Script;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * Class ServiceTest
 * @package OxidProfessionalServices\Usercentrics\Tests\Unit
 */
#[CoversClass(\OxidProfessionalServices\Usercentrics\DataObject\Script::class)]
class ScriptTest extends TestCase
{
    public function testHasPath(): void
    {
        $service = new Script('test/path', 'testServiceId');
        $this->assertSame('test/path', $service->getPath());
    }

    public function testHasServiceId(): void
    {
        $service = new Script('test/path', 'testServiceId');
        $this->assertSame('testServiceId', $service->getServiceId());
    }
}
