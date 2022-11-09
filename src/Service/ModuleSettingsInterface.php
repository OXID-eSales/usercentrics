<?php

namespace OxidProfessionalServices\Usercentrics\Service;

interface ModuleSettingsInterface
{
    public function getUsercentricsId(): string;
    public function getUsercentricsMode(): string;

    public function getSmartProtectorBlockingDisabledList(): string;

    public function isSmartProtectorEnabled(): bool;
    public function isDevelopmentAutoConsentEnabled(): bool;
}
