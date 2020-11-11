<?php
declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\Tests\Unit\Service;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function testExample(): void
    {
        $config = \OxidEsales\Eshop\Core\Registry::get(\OxidEsales\Eshop\Core\Config::class);
        $this->assertInstanceOf(\OxidEsales\Eshop\Core\Config::class, $config);
    }
}