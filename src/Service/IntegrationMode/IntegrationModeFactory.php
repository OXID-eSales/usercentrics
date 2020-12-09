<?php

namespace OxidProfessionalServices\Usercentrics\Service\IntegrationMode;

class IntegrationModeFactory implements IntegrationModeFactoryInterface
{
    public const MODE_CMPV1 = 'CMPv1';
    public const MODE_CMPV2 = 'CMPv2';
    public const MODE_CMPV2_LEGACY = 'CMPv2Legacy';
    public const MODE_CMPV2_TCF = 'CMPv2Tcf';
    public const MODE_CMPV2_TCF_LEGACY = 'CMPv2TcfLegacy';
    public const MODE_CUSTOM = 'Custom';

    private const MODES = [
        self::MODE_CMPV1 => CmpV1::class,
        self::MODE_CMPV2 => CmpV2::class,
        self::MODE_CMPV2_LEGACY => CmpV2Legacy::class,
        self::MODE_CMPV2_TCF => CmpTcf::class,
        self::MODE_CMPV2_TCF_LEGACY => CmpTcfLegacy::class,
        self::MODE_CUSTOM => CustomCmp::class
    ];

    public function createIntegrationMode(string $mode, string $id): IntegrationScriptModeInterface
    {
        $className = static::MODES[$mode] ?? CmpV2::class;
        return new $className($id);
    }
}
