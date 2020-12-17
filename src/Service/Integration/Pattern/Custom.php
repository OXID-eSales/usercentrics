<?php

namespace OxidProfessionalServices\Usercentrics\Service\Integration\Pattern;

class Custom implements IntegrationPatternInterface
{
    public const VERSION_NAME = 'Custom';

    public function getIntegrationScriptPattern(): string
    {
        return '';
    }
}
