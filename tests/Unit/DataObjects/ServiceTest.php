<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidProfessionalServices\Usercentrics\Tests\Unit\DataObjects;

use OxidProfessionalServices\Usercentrics\DataObject\Service;
use PHPUnit\Framework\TestCase;

/**
 * Class ServiceTest
 * @package OxidProfessionalServices\Usercentrics\Tests\Unit
 * @covers \OxidProfessionalServices\Usercentrics\DataObject\Service
 */
class ServiceTest extends TestCase
{
    public function testHasName(): void
    {
        $service = new Service('testName', 'testId');
        $this->assertSame('testName', $service->getName());
    }

    public function testHasId(): void
    {
        $service = new Service('testName', 'testId');
        $this->assertSame('testId', $service->getId());
    }
}
