<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidProfessionalServices\Usercentrics\Core;

use OxidProfessionalServices\Usercentrics\Service\IntegrationScriptInterface;
use OxidProfessionalServices\Usercentrics\Service\ModuleSettingsInterface;

class ViewConfig extends ViewConfig_parent
{
    public function isSmartDataProtectorActive(): bool
    {
        $moduleSettings = $this->getContainer()->get(ModuleSettingsInterface::class);
        return $moduleSettings->getSettingValue('smartDataProtectorActive', true);
    }

    /**
     * @return string
     *
     * @deprecated
     */
    public function getUsercentricsID(): string
    {
        $moduleSettings = $this->getContainer()->get(ModuleSettingsInterface::class);
        return $moduleSettings->getSettingValue('usercentricsId', '');
    }

    public function getUsercentricsScript(): string
    {
        /**
         * @psalm-suppress InternalMethod
         * @var IntegrationScriptInterface $service
         */
        $service = $this->getContainer()->get(IntegrationScriptInterface::class);
        return $service->getIntegrationScript();
    }

    public function isDevelopmentAutomaticConsentActive(): bool
    {
        $moduleSettings = $this->getContainer()->get(ModuleSettingsInterface::class);
        return $moduleSettings->getSettingValue('developmentAutomaticConsent', false);
    }

    public function getSmartDataProtectorDeactivateBlockingServices(): array
    {
        $moduleSettings = $this->getContainer()->get(ModuleSettingsInterface::class);
        $value = $moduleSettings->getSettingValue('smartDataProtectorDeactivateBlocking', '');

        return array_map(function ($value) {
            return trim($value);
        }, explode(",", $value));
    }
}
