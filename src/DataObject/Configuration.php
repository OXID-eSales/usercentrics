<?php

declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\DataObject;

/** @psalm-immutable */
final class Configuration
{
    /**
     * @var Script[]
     */
    private $scripts;

    /**
     * @var Service[]
     */
    private $services;

    /**
     * @var ScriptSnippet[]
     */
    private $scriptSnippets;

    /**
     * Configuration constructor.
     *
     * @param Script[] $scripts
     * @param Service[] $services
     * @param ScriptSnippet[] $scriptSnippets
     */
    public function __construct(array $scripts, array $services, array $scriptSnippets)
    {
        $this->scripts = $scripts;
        $this->services = $services;
        $this->scriptSnippets = $scriptSnippets;
    }

    /**
     * @return Script[]
     */
    public function getScripts(): array
    {
        return $this->scripts;
    }

    /**
     * @return Service[]
     */
    public function getServices(): array
    {
        return $this->services;
    }

    /**
     * @return ScriptSnippet[]
     */
    public function getScriptSnippets(): array
    {
        return $this->scriptSnippets;
    }
}
