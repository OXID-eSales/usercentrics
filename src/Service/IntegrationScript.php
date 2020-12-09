<?php


namespace OxidProfessionalServices\Usercentrics\Service;


use OxidEsales\Eshop\Core\Registry;
use OxidProfessionalServices\Usercentrics\Service\IntegrationMode\IntegrationModeFactory;
use OxidProfessionalServices\Usercentrics\Service\IntegrationMode\IntegrationModeFactoryInterface;

class IntegrationScript
{
    /** @var IntegrationModeFactoryInterface */
    private $factory;
    public function __construct(IntegrationModeFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function getUsercentricsID(): string
    {
        /** @var string */
        return Registry::getConfig()->getConfigParam('usercentricsId', '');
    }

    private function getUsercentricsMode(): string
    {
        /** @var string */
        return Registry::getConfig()->getConfigParam('usercentricsMode', '');
    }

    public function getUsercentricsScript(): string
    {
        $id = $this->getUsercentricsID();
        $mode = $this->getUsercentricsMode();
        $integration = $this->factory->createIntegrationMode($mode, $id);
        return $integration->getHtml();
    }
}
