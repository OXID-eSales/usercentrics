<?php

namespace OxidProfessionalServices\Usercentrics\Service;

interface ModuleSettingsInterface
{
    public function getSettingValue(string $settingName): string;
}
