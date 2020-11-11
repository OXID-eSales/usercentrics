<?php


namespace OxidProfessionalServices\Usercentrics\Service;

interface FileFormat
{
    public function parse(string $path): array;
    public function dump(array $data, string $path): void;
}
