<?php

namespace OxidProfessionalServices\Usercentrics\Core;

use OxidEsales\Eshop\Core\Registry;

class ViewConfig extends ViewConfig_parent
{
    /**
     * @return bool
     */
    public function isSmartDataProtectorActive(): bool
    {
        /** @var bool */
        return Registry::getConfig()->getConfigParam('smartDataProtectorActive', true);
    }
    /**
     * @return string
     */
    public function getUsercentricsID(): string
    {
        /** @var string */
        return Registry::getConfig()->getConfigParam('usercentricsId');
    }
}
