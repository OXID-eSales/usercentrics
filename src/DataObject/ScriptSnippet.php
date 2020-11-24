<?php

declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\DataObject;

/** @psalm-immutable */
final class ScriptSnippet
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $serviceId;

    /**
     * Script constructor.
     *
     * @param string $id
     * @param string $serviceId
     */
    public function __construct(string $id, string $serviceId)
    {
        $this->id = $id;
        $this->serviceId = $serviceId;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getServiceId(): string
    {
        return $this->serviceId;
    }
}
