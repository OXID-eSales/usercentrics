<?php

declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\Service;

use Exception;
use OxidProfessionalServices\Usercentrics\DataObject\Script;
use OxidProfessionalServices\Usercentrics\DataObject\Service;
use OxidProfessionalServices\Usercentrics\Service\Configuration\ConfigurationDaoInterface;

class ScriptServiceMapper implements ScriptServiceMapperInterface
{
    /**
     * @var ConfigurationDaoInterface
     */
    private $configurationDao;

    /**
     * This is a map of service path as key with a service id
     * @example: ['some/path/to/script.js' => 'SomeConfiguredServiceId']
     *
     * @var array<string,?Service>
     */
    private $scriptPathServices;

    public function __construct(ConfigurationDaoInterface $configurationDao)
    {
        $this->configurationDao = $configurationDao;
        $this->scriptPathServices = $this->mapScriptPathsToServices();
    }

    public function checkPathShouldBeProcessed(string $pathOrUrl): bool
    {
        $scriptsByPath = $this->scriptPathServices;
        return isset($scriptsByPath[$pathOrUrl]);
    }

    public function getScriptPathService(string $pathOrUrl): ?Service
    {
        $scriptsByPath = $this->scriptPathServices;
        return isset($scriptsByPath[$pathOrUrl]) ? $scriptsByPath[$pathOrUrl] : null;
    }

    /**
     * @throws Exception
     */
    public function checkSnippetShouldBeProcessed(string $snippet): bool
    {
        //@todo
        throw new Exception("Widgets are not yet supported");
    }

    /**
     * @return array<string,?Service>
     */
    protected function mapScriptPathsToServices(): array
    {
        $config = $this->configurationDao->getConfiguration();
        $scripts = $config->getScripts();
        $services = $config->getServices();
        $result = [];

        foreach ($scripts as $oneScript) {
            $result[$oneScript->getPath()] = $services[$oneScript->getServiceId()] ?? null;
        }

        return $result;
    }
}
