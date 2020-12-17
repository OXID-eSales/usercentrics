<?php

namespace OxidProfessionalServices\Usercentrics\Service\Integration\Pattern;

class CmpV1 implements IntegrationPatternInterface
{
    public const VERSION_NAME = 'CmpV1';

    protected $scriptSource = 'https://app.usercentrics.eu/latest/main.js';

    public function getIntegrationScriptPattern(): string
    {
        return '<script type="application/javascript" 
            src="' . $this->scriptSource . '" 
            id="{USERCENTRICS_CLIENT_ID}"></script>';
    }
}
