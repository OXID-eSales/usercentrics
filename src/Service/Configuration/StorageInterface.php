<?php

declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\Service\Configuration;

interface StorageInterface
{
    /**
     * @return mixed[]
     */
    public function getData(): array;

    /**
     * @param mixed[] $data
     */
    public function putData(array $data): void;
}
