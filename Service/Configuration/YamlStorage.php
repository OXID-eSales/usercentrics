<?php

declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\Service\Configuration;

use Symfony\Component\Yaml\Dumper;
use Symfony\Component\Yaml\Parser;

class YamlStorage implements StorageInterface
{
    /** @var Dumper */
    private $dumper;

    /** @var Parser */
    private $parser;

    /** @var string */
    private $directory;

    /** @var string */
    private $fileName;

    public function __construct(string $directory, string $fileName)
    {
        $this->dumper = new Dumper();
        $this->parser = new Parser();
        $this->directory = $directory;
        $this->fileName = $fileName;
    }


    public function getData(): array
    {
        $result = $this->parser->parseFile($this->getConfigurationFilePath());

        if (!is_array($result)) {
            $result = [];
        }

        return $result;
    }

    public function putData(array $data): void
    {
        $yamlData = $this->dumper->dump($data, 2);

        file_put_contents($this->getConfigurationFilePath(), $yamlData);
    }

    private function getConfigurationFilePath(): string
    {
        return $this->directory . DIRECTORY_SEPARATOR . $this->fileName;
    }
}
