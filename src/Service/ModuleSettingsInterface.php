<?php

namespace OxidProfessionalServices\Usercentrics\Service;

interface ModuleSettingsInterface
{
    /**
     * @param string $settingName
     * @param mixed|null $defaultValue
     * @return mixed
     */
    public function getSettingValue(string $settingName, $defaultValue = null);
}
