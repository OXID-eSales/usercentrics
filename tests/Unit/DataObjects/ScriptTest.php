<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidProfessionalServices\Usercentrics\Tests\Unit\DataObjects;

use OxidEsales\TestingLibrary\UnitTestCase;
use OxidProfessionalServices\Usercentrics\DataObject\Script;
use OxidProfessionalServices\Usercentrics\DataObject\Service;

/**
 * Class ServiceTest
 * @package OxidProfessionalServices\Usercentrics\Tests\Unit
 * @covers \OxidProfessionalServices\Usercentrics\DataObject\Script
 */
class ScriptTest extends UnitTestCase
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
