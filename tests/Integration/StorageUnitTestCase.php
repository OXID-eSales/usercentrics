<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidProfessionalServices\Usercentrics\Tests\Integration;

use org\bovigo\vfs\vfsStream;
use OxidProfessionalServices\Usercentrics\Service\Configuration\StorageInterface;
use OxidProfessionalServices\Usercentrics\Service\Configuration\YamlStorage;
use PHPUnit\Framework\TestCase;

/**
 * Helper methods for tests
 */
class StorageUnitTestCase extends TestCase
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
}
