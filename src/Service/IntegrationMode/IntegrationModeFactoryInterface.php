<?php

namespace OxidProfessionalServices\Usercentrics\Service\IntegrationMode;

interface IntegrationModeFactoryInterface
{
    public function createIntegrationMode(string $mode, string $id): IntegrationScriptModeInterface;
}
