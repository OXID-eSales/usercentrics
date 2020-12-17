<?php

namespace OxidProfessionalServices\Usercentrics\Service\Integration\Pattern;

class CmpV2 implements IntegrationPatternInterface
{
    public const VERSION_NAME = 'CmpV2';

    protected $scriptSource = 'https://app.usercentrics.eu/browser-ui/latest/bundle.js';

    public function getIntegrationScriptPattern(): string
    {
        return '<script id="usercentrics-cmp"
            data-settings-id="{USERCENTRICS_CLIENT_ID}"
            src="' . $this->scriptSource . '"
            defer></script>';
    }
}
