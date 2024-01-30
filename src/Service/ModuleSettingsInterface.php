<?php

namespace OxidProfessionalServices\Usercentrics\Service;

interface ModuleSettingsInterface
{
    public function getUsercentricsId(): string;
    public function getUsercentricsMode(): string;

    /**
     * @return string[]
     */
    public function getSmartProtectorBlockingDisabledServices(): array;

    public function isSmartProtectorEnabled(): bool;
    public function isDevelopmentAutoConsentEnabled(): bool;
}
