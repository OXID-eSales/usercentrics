<?php

declare(strict_types=1);

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
     * @return Service[]
     */
    public function getServices(): array
    {
        return $this->services;
    }
}
