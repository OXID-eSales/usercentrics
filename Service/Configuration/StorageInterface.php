<?php

declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\Service\Configuration;

interface StorageInterface
{
    public function getData(): array;
    public function putData($data): void;
}
