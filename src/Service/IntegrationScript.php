<?php

namespace OxidProfessionalServices\Usercentrics\Service;

use OxidProfessionalServices\Usercentrics\Service\Integration\IntegrationScriptBuilderInterface;

class IntegrationScript
{
    /** @var IntegrationScriptBuilderInterface */
    private $scriptBuilder;

    /** @var ModuleSettingsInterface */
    private $moduleSettings;

    public function __construct(
        IntegrationScriptBuilderInterface $scriptBuilder,
        ModuleSettingsInterface $moduleSettings
    ) {
        $this->scriptBuilder = $scriptBuilder;
        $this->moduleSettings = $moduleSettings;
    }

    public function getIntegrationScript(): string
    {
        $id = $this->moduleSettings->getSettingValue('usercentricsId');
        $mode = $this->moduleSettings->getSettingValue('usercentricsMode');

        $params = [
            '{USERCENTRICS_CLIENT_ID}' => $id
        ];

        return $this->scriptBuilder->getIntegrationScript($mode, $params);
    }
}
