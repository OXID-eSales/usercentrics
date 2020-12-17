<?php

namespace OxidProfessionalServices\Usercentrics\Service;

use OxidProfessionalServices\Usercentrics\Service\IntegrationMode\IntegrationModeFactoryInterface;

class IntegrationScript
{
    /** @var IntegrationModeFactoryInterface */
    private $factory;

    /** @var ModuleSettings */
    private $moduleSettings;

    public function __construct(
        IntegrationModeFactoryInterface $factory,
        ModuleSettings $moduleSettings
    ) {
        $this->factory = $factory;
        $this->moduleSettings = $moduleSettings;
    }

    public function getIntegrationScript(): string
    {
        $id = $this->moduleSettings->getSettingValue('usercentricsId');
        $mode = $this->moduleSettings->getSettingValue('usercentricsMode');

        $integration = $this->factory->createIntegrationMode($mode, $id);

        return $integration->getHtml();
    }
}
