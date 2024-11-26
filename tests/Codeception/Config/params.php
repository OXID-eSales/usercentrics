<?php

// phpcs:disable
declare(strict_types=1);

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

use OxidEsales\Codeception\Module\Database\DatabaseDefaultsFileGenerator;
use OxidEsales\Facts\Facts;
use OxidEsales\Facts\Config\ConfigFile;

$facts = new Facts();

$phpBinEnv = (getenv('PHPBIN')) ? : 'php';

$screenShotPathEnv = getenv('CC_SCREEN_SHOTS_PATH');
$screenShotPathEnv = ($screenShotPathEnv) ? : '';

return [
    'SHOP_URL' => $facts->getShopUrl(),
    'SHOP_SOURCE_PATH' => $facts->getSourcePath(),
    'SOURCE_RELATIVE_PACKAGE_PATH' => getSourceRelativePackagePath($facts),
    'VENDOR_PATH' => $facts->getVendorPath(),
    'DB_NAME' => $facts->getDatabaseName(),
    'DB_USERNAME' => $facts->getDatabaseUserName(),
    'DB_PASSWORD' => $facts->getDatabasePassword(),
    'DB_HOST' => $facts->getDatabaseHost(),
    'DB_PORT' => $facts->getDatabasePort(),
    'DUMP_PATH' => getTestDataDumpFilePath(),
    'FIXTURES_PATH' => getTestFixtureSqlFilePath(),
    'MYSQL_CONFIG_PATH' => getMysqlConfigPath(),
    'SELENIUM_SERVER_PORT' => getenv('SELENIUM_SERVER_PORT') ?: '4444',
    'SELENIUM_SERVER_IP' => getenv('SELENIUM_SERVER_IP') ?: 'selenium',
    'THEME_ID' => getenv('THEME_ID') ?: 'twig',
    'BROWSER_NAME' => getenv('BROWSER_NAME') ?: 'chrome',
    'PHP_BIN' => $phpBinEnv,
    'SCREEN_SHOT_URL' => $screenShotPathEnv
];

function getSourceRelativePackagePath(Facts $facts): string
{
	return str_replace($facts->getShopRootPath(), '..', __DIR__) . '/../../../';
}

function getTestDataDumpFilePath(): string
{
    return getShopTestPath() . '/Codeception/Support/Data/generated/shop-dump.sql';
}

function getTestFixtureSqlFilePath(): string
{
    return getShopTestPath() . '/Codeception/Support/Data/dump.sql';
}

function getShopTestPath(): string
{
    $facts = new Facts();

    if ($facts->isEnterprise()) {
        $shopTestPath = $facts->getEnterpriseEditionRootPath() . '/Tests';
    } elseif ($facts->isProfessional()) {
        $shopTestPath = $facts->getProfessionalEditionRootPath() . '/Tests';
    } else {
        $shopTestPath = $facts->getCommunityEditionRootPath() . '/tests';
    }

    return $shopTestPath;
}

function getMysqlConfigPath(): string
{
    $configFile = new ConfigFile();

    return (new DatabaseDefaultsFileGenerator($configFile))->generate();
}