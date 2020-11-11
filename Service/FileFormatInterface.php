<?php


namespace OxidProfessionalServices\Usercentrics\Service;

interface FileFormatInterface
{
    public function parse(string $path): array;
    public function dump(array $data, string $path): void;
}
