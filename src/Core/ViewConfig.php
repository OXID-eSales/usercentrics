<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidProfessionalServices\Usercentrics\Core;

use OxidEsales\Eshop\Core\Registry;
use OxidProfessionalServices\Usercentrics\Service\IntegrationScriptInterface;

class ViewConfig extends ViewConfig_parent
{
    public function isSmartDataProtectorActive(): bool
    {
        /** @var bool */
        return Registry::getConfig()->getConfigParam('smartDataProtectorActive', true);
    }

    /**
     * @return string
     *
     * @deprecated
     */
    public function getUsercentricsID(): string
    {
        /** @var string */
        return Registry::getConfig()->getConfigParam('usercentricsId');
    }

    public function getUsercentricsScript(): string
    {
        /**
         * @psalm-suppress InternalMethod
         * @var IntegrationScriptInterface $service
         */
        $service = $this->getContainer()->get(IntegrationScriptInterface::class);
        return $service->getUsercentricsScript();
    }
}
