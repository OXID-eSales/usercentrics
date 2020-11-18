<?php
declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\Tests\Unit\Service;

use OxidEsales\Eshop\Core\Config;
use OxidEsales\Eshop\Core\Registry;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function testExample(): void
    {
        $config = Registry::get(Config::class);
        $this->assertInstanceOf(Config::class, $config);
        $this->assertTrue(false);
    }
}
