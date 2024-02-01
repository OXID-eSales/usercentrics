<?php

namespace OxidProfessionalServices\Usercentrics\Service;

use OxidProfessionalServices\Usercentrics\Service\Integration\IntegrationScriptBuilderInterface;

class IntegrationScript implements IntegrationScriptInterface
{
    public function __construct(
        private readonly IntegrationScriptBuilderInterface $scriptBuilder,
        private readonly ModuleSettingsInterface $moduleSettings
    ) {
    }

    public function getIntegrationScript(): string
    {
        $clientId = $this->moduleSettings->getUsercentricsId();
        $mode = $this->moduleSettings->getUsercentricsMode();

        $params = [
            '{USERCENTRICS_CLIENT_ID}' => $clientId
        ];

        return $this->scriptBuilder->getIntegrationScript($mode, $params);
    }
}
