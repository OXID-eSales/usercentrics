<?php

namespace OxidProfessionalServices\Usercentrics\Service\IntegrationMode;

class IntegrationModeFactory implements IntegrationModeFactoryInterface
{
    public const MODE_CMPV1 = 'CmpV1';
    public const MODE_CMPV2 = 'CmpV2';
    public const MODE_CMPV2_LEGACY = 'CmpV2Legacy';
    public const MODE_CMPV2_TCF = 'CmpTcf';
    public const MODE_CMPV2_TCF_LEGACY = 'CmpTcfLegacy';
    public const MODE_CUSTOM = 'Custom';

    public function createIntegrationMode(string $mode, string $id): IntegrationScriptModeInterface
    {
        switch ($mode) {
            case self::MODE_CMPV1:
                return new CmpV1($id);
            case self::MODE_CMPV2_LEGACY:
                return new CmpV2Legacy($id);
            case self::MODE_CMPV2_TCF:
                return new CmpTcf($id);
            case self::MODE_CMPV2_TCF_LEGACY:
                return new CmpTcfLegacy($id);
            case self::MODE_CUSTOM:
                return new Custom();
            default:
                return new CmpV2($id);
        }
    }
}
