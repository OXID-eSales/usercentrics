<?php


namespace OxidProfessionalServices\Usercentrics\DataObject;

class Script
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $serviceId;

    /**
     * Script constructor.
     * @param string $path
     * @param string $serviceId
     */
    public function __construct(string $path, string $serviceId)
    {
        $this->path = $path;
        $this->serviceId = $serviceId;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getServiceId(): string
    {
        return $this->serviceId;
    }

    /**
     * @param string $serviceId
     */
    public function setServiceId(string $serviceId): void
    {
        $this->serviceId = $serviceId;
    }
}
