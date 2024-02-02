<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidProfessionalServices\Usercentrics\Tests\Codeception\Module;

use Codeception\Lib\Interfaces\DependsOnModule;
use Codeception\Module;
use OxidProfessionalServices\Usercentrics\DataObject\Configuration;
use OxidProfessionalServices\Usercentrics\Service\Configuration\ConfigurationDao;
use OxidProfessionalServices\Usercentrics\Service\Configuration\YamlStorage;

/**
 * Class Config
 */
class Config extends Module implements DependsOnModule
{
    protected array $requiredFields = ['shop_path', 'config_file'];
    protected array $config = [
        'shop_path' => '',
        'config_file' => ''
    ];

    public function _depends(): array
    {
        return [];
    }

    private function getConfigManager(): ConfigurationDao
    {
        $storage = new YamlStorage(
            $this->config['shop_path'],
            $this->config['config_file']
        );

        return new ConfigurationDao($storage);
    }

    public function getConfiguration(): Configuration
    {
        $configManager = $this->getConfigManager();
        return $configManager->getConfiguration();
    }

    public function putConfiguration(Configuration $configuration): void
    {
        $configManager = $this->getConfigManager();
        $configManager->putConfiguration($configuration);
    }
}
