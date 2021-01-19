<?php

namespace OxidProfessionalServices\Usercentrics\Service\Integration\Pattern;

class CmpV2Tcf implements IntegrationPatternInterface
{
    public const VERSION_NAME = 'CmpV2Tcf';

    protected $scriptSource = 'https://app.usercentrics.eu/browser-ui/latest/bundle.js';

    public function getIntegrationScriptPattern(): string
    {
        return '<script id="usercentrics-cmp"
            data-settings-id="{USERCENTRICS_CLIENT_ID}"
            src="' . $this->scriptSource . '"
            data-tcf-enabled
            defer></script>';
    }
}
