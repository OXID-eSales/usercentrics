<?php

namespace OxidProfessionalServices\Usercentrics\Service;

use OxidProfessionalServices\Usercentrics\Service\Integration\IntegrationScriptBuilderInterface;

class IntegrationScript
{
    public function __construct(
        private readonly IntegrationScriptBuilderInterface $scriptBuilder,
        private readonly ModuleSettingsInterface $moduleSettings
    ) {
    }

    public function getIntegrationScript(): string
    {
        $id = $this->moduleSettings->getUsercentricsId();
        $mode = $this->moduleSettings->getUsercentricsMode();

        $params = [
            '{USERCENTRICS_CLIENT_ID}' => $id
        ];

        return $this->scriptBuilder->getIntegrationScript($mode, $params);
    }
}
