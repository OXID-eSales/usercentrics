<?php


namespace OxidProfessionalServices\Usercentrics\Service;

use Symfony\Component\Yaml\Dumper;
use Symfony\Component\Yaml\Parser;

class Yaml implements FileFormat
{
    /**
     * @var Parser
     */
    private $parser;

    /**
     * @var Dumper
     */
    private $dumper;

    /**
     * Yaml constructor.
     * @param Parser|null $parser
     * @param Dumper|null $dumper
     */
    public function __construct(Parser $parser = null, Dumper $dumper = null)
    {
        if (!isset($parser)) {
            $parser = new Parser();
        }
        $this->parser = $parser;
        if (!isset($dumper)) {
            $dumper = new Dumper();
        }
        $this->dumper = $dumper;
    }


    /**
     * @param string $path
     * @return array
     */
    public function parse(string $path): array
    {
        $result = $this->parser->parseFile($path);
        if (!is_array($result)) {
            return [];
        }
        return $result;
    }

    public function dump(array $data, string $path): void
    {
        $yamlData = $this->dumper->dump($data, 2);
        file_put_contents($path, $yamlData);
    }
}
