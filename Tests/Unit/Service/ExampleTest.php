<?php
declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\Tests\Unit\Service;

use OxidEsales\Eshop\Core\Registry;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function testSmartDataProtectorActiveByDefault(): void
    {
        $viewConfig = Registry::get(\OxidEsales\Eshop\Core\ViewConfig::class);
       // $this->assertInstanceOf(JavaScriptRenderer::class, $viewConfig);
        $enabled = $viewConfig->isSmartDataProtectorActive();
        $this->assertTrue($enabled);
    }
}
