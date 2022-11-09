<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidProfessionalServices\Usercentrics\Core;

use OxidProfessionalServices\Usercentrics\Service\IntegrationScriptInterface;
use OxidProfessionalServices\Usercentrics\Service\ModuleSettingsInterface;
use OxidProfessionalServices\Usercentrics\Traits\ServiceContainer;

class ViewConfig extends ViewConfig_parent
{
    use ServiceContainer;

    public function isSmartDataProtectorActive(): bool
    {
        $moduleSettings = $this->getServiceFromContainer(ModuleSettingsInterface::class);
        return $moduleSettings->isSmartProtectorEnabled();
    }

    /**
     * @return string
     *
     * @deprecated
     */
    public function getUsercentricsID(): string
    {
        $moduleSettings = $this->getServiceFromContainer(ModuleSettingsInterface::class);
        return $moduleSettings->getUsercentricsId();
    }

    public function getUsercentricsScript(): string
    {
        /**
         * @psalm-suppress InternalMethod
         * @var IntegrationScriptInterface $service
         */
        $service = $this->getServiceFromContainer(IntegrationScriptInterface::class);
        return $service->getIntegrationScript();
    }

    public function isDevelopmentAutomaticConsentActive(): bool
    {
        $moduleSettings = $this->getServiceFromContainer(ModuleSettingsInterface::class);
        return $moduleSettings->isDevelopmentAutoConsentEnabled();
    }

    public function getSmartDataProtectorDeactivateBlockingServices(): array
    {
        $moduleSettings = $this->getServiceFromContainer(ModuleSettingsInterface::class);
        $value = $moduleSettings->getSmartProtectorBlockingDisabledList();

        return array_map(function ($value) {
            return trim($value);
        }, explode(",", $value));
    }
}
