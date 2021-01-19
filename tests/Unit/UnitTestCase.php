<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidProfessionalServices\Usercentrics\Tests\Unit;

use DOMDocument;
use org\bovigo\vfs\vfsStream;
use OxidProfessionalServices\Usercentrics\Service\Configuration\StorageInterface;
use OxidProfessionalServices\Usercentrics\Service\Configuration\YamlStorage;
use PHPUnit\Framework\TestCase;

/**
 * Helper methods for tests
 */
class UnitTestCase extends TestCase
{
    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    protected function getVirtualStructurePath(array $structure = []): string
    {
        $baseDir = vfsStream::setup('root', 444);
        vfsStream::create($structure, $baseDir);
        return vfsStream::url('root');
    }

    protected function getStorage(string $file, string $directory = ''): StorageInterface
    {
        return new YamlStorage(
            $directory,
            $file
        );
    }

    public function assertHtmlEquals(string $expected, string $actual): void
    {
        $eDom = new DOMDocument();
        $eDom->loadHTML($expected, LIBXML_HTML_NOIMPLIED);

        $aDom = new DOMDocument();
        $aDom->loadHTML($actual, LIBXML_HTML_NOIMPLIED);

        $this->assertXmlStringEqualsXmlString($eDom, $aDom);
    }
}
