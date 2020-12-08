<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidProfessionalServices\Usercentrics\Tests\Unit\DataObjects;

use OxidProfessionalServices\Usercentrics\DataObject\Configuration;
use OxidProfessionalServices\Usercentrics\DataObject\Script;
use OxidProfessionalServices\Usercentrics\DataObject\ScriptSnippet;
use OxidProfessionalServices\Usercentrics\DataObject\Service;
use PHPUnit\Framework\TestCase;

/**
 * Class ServiceTest
 * @package OxidProfessionalServices\Usercentrics\Tests\Unit
 * @covers \OxidProfessionalServices\Usercentrics\DataObject\Configuration
 */
class ConfigurationTest extends TestCase
{
    public function testHasService(): void
    {
        $service = new Service('name', 'id');
        $configuration = new Configuration(
            [$service],
            [],
            []
        );
        $services = $configuration->getServices();
        $this->assertCount(1, $services);
        $this->assertSame($service, $services[0]);
    }

    public function testHasScript(): void
    {
        $script = new Script('path', 'id');
        $configuration = new Configuration(
            [],
            [$script],
            []
        );
        $scripts = $configuration->getScripts();
        $this->assertCount(1, $scripts);
        $this->assertSame($script, $scripts[0]);
    }

    public function testHasScriptSnippets(): void
    {
        $scriptSnippet = new ScriptSnippet('123', 'id');
        $configuration = new Configuration(
            [],
            [],
            [$scriptSnippet]
        );
        $scripts = $configuration->getScriptSnippets();
        $this->assertCount(1, $scripts);
        $this->assertSame($scriptSnippet, $scripts[0]);
    }
}
