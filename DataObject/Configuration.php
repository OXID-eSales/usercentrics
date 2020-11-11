<?php

namespace OxidProfessionalServices\Usercentrics\DataObject;

class Configuration
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
     * Configuration constructor.
     * @param Script[] $scripts
     * @param Service[] $services
     */
    public function __construct(array $scripts, array $services)
    {
        $this->scripts = $scripts;
        $this->services = $services;
    }

    /**
     * @return Script[]
     */
    public function getScripts(): array
    {
        return $this->scripts;
    }

    /**
     * @param Script[] $scripts
     */
    public function setScripts(array $scripts): void
    {
        $this->scripts = $scripts;
    }

    /**
     * @return Service[]
     */
    public function getServices(): array
    {
        return $this->services;
    }

    /**
     * @param Service[] $services
     */
    public function setServices(array $services): void
    {
        $this->services = $services;
    }
}
