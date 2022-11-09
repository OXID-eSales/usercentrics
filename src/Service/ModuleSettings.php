<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\Service;

use OxidEsales\EshopCommunity\Internal\Framework\Module\Facade\ModuleSettingServiceInterface;
use OxidProfessionalServices\Usercentrics\Core\Module;

final class ModuleSettings implements ModuleSettingsInterface
{
    public const USERCENTRICS_ID = 'usercentricsId';
    public const USERCENTRICS_MODE = 'usercentricsMode';

    public const USERCENTRICS_SMART_DATA_PROTECTOR_ENABLED = 'smartDataProtectorActive';
    public const USERCENTRICS_SMART_DATA_PROTECTOR_BLOCKING_DISABLED = 'smartDataProtectorDeactivateBlocking';

    public const USERCENTRICS_DEVELOPMENT_AUTO_CONSENT = 'developmentAutomaticConsent';

    /** @var ModuleSettingServiceInterface */
    private $moduleSettingService;

    public function __construct(
        ModuleSettingServiceInterface $moduleSettingService
    ) {
        $this->moduleSettingService = $moduleSettingService;
    }

    public function getUsercentricsId(): string
    {
        return $this->getStringSettingValue(self::USERCENTRICS_ID);
    }

    public function getUsercentricsMode(): string
    {
        return $this->getStringSettingValue(self::USERCENTRICS_MODE);
    }

    public function isSmartProtectorEnabled(): bool
    {
        return $this->moduleSettingService->getBoolean(
            self::USERCENTRICS_SMART_DATA_PROTECTOR_ENABLED,
            Module::MODULE_ID
        );
    }

    public function getSmartProtectorBlockingDisabledList(): string
    {
        return $this->getStringSettingValue(self::USERCENTRICS_SMART_DATA_PROTECTOR_BLOCKING_DISABLED);
    }

    public function isDevelopmentAutoConsentEnabled(): bool
    {
        return $this->moduleSettingService->getBoolean(
            self::USERCENTRICS_DEVELOPMENT_AUTO_CONSENT,
            Module::MODULE_ID
        );
    }

    protected function getStringSettingValue($key): string
    {
        return $this->moduleSettingService->getString(
            $key,
            Module::MODULE_ID
        )->trim()->toString();
    }
}
