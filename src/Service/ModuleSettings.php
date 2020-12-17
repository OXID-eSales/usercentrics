<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\Service;

use OxidEsales\EshopCommunity\Internal\Framework\Module\Configuration\Exception\ModuleSettingNotFountException;
use OxidEsales\EshopCommunity\Internal\Framework\Module\Setting\SettingDaoInterface;
use OxidEsales\EshopCommunity\Internal\Transition\Utility\ContextInterface;

final class ModuleSettings implements ModuleSettingsInterface
{
    /** @var string */
    private $moduleId;

    /** @var SettingDaoInterface */
    private $settingsDao;

    /** @var ContextInterface */
    private $context;

    public function __construct(
        string $moduleId,
        SettingDaoInterface $settingsDao,
        ContextInterface $context
    ) {
        $this->moduleId = $moduleId;
        $this->settingsDao = $settingsDao;
        $this->context = $context;
    }

    public function getSettingValue(string $settingName): string
    {
        try {
            $setting = $this->settingsDao->get(
                $settingName,
                $this->moduleId,
                $this->context->getCurrentShopId()
            );
            $result = $setting->getValue();
        } catch (ModuleSettingNotFountException $e) {
            $result = '';
        }

        return $result;
    }
}
