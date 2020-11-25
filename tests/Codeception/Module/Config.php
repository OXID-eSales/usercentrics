<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidProfessionalServices\Usercentrics\Tests\Codeception\Module;

use Codeception\Lib\Interfaces\DependsOnModule;
use OxidProfessionalServices\Usercentrics\DataObject\Configuration;
use OxidProfessionalServices\Usercentrics\Service\Configuration\ConfigurationDao;
use OxidProfessionalServices\Usercentrics\Service\Configuration\YamlStorage;

/**
 * Class Config
 */
class Config extends \Codeception\Module implements DependsOnModule
{
    protected $requiredFields = ['shop_path', 'config_file'];
    protected $config = [
        'shop_path' => '',
        'config_file' => ''
    ];

    public function _depends()
    {
        return [];
    }

    private function getConfigManager(): ConfigurationDao
    {
        $storage =  new YamlStorage(
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
