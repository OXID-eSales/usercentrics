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
    public function getUsercentricsModuleSettings(): ModuleSettingsInterface
    {
        return $this->getService(ModuleSettingsInterface::class);
    }

    public function getUsercentricsScript(): string
    {
        /**
         * @psalm-suppress InternalMethod
         * @var IntegrationScriptInterface $service
         */
        $service = $this->getService(IntegrationScriptInterface::class);
        return $service->getIntegrationScript();
    }
}
