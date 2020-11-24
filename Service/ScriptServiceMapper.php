<?php

declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\Service;

use Exception;
use OxidProfessionalServices\Usercentrics\DataObject\Script;
use OxidProfessionalServices\Usercentrics\DataObject\Service;
use OxidProfessionalServices\Usercentrics\Service\Configuration\ConfigurationDaoInterface;

final class ScriptServiceMapper implements ScriptServiceMapperInterface
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
    private $scriptPathToService;

    /**
     * @var array<string,?Service>
     */
    private $snippetToService;

    public function __construct(ConfigurationDaoInterface $configurationDao)
    {
        $this->configurationDao = $configurationDao;
        $this->scriptPathToService = $this->mapScriptPathsToServices();
        $this->snippetToService = $this->mapScriptSnippetToServices();
    }

    public function getServiceByScriptPath(string $pathOrUrl): ?Service
    {
        return $this->scriptPathToService[$pathOrUrl] ?? null;
    }

    public function getServiceBySnippetId(string $snippetId): ?Service
    {
        return $this->snippetToService[$snippetId] ?? null;
    }


    protected function getServiceById(string $serviceId): ?Service
    {
        $config = $this->configurationDao->getConfiguration();
        $services = $config->getServices();
        
        return $services[$serviceId] ?? null;
    }

    /**
     * @return array<string,?Service>
     */
    protected function mapScriptPathsToServices(): array
    {
        $config = $this->configurationDao->getConfiguration();
        $scripts = $config->getScripts();
        $result = [];

        foreach ($scripts as $oneScript) {
            $serviceId = $oneScript->getServiceId();
            $result[$oneScript->getPath()] = $this->getServiceById($serviceId);
        }

        return $result;
    }

    /**
     * @return array<string,?Service>
     */
    public function mapScriptSnippetToServices(): array
    {
        $config = $this->configurationDao->getConfiguration();
        $scripts = $config->getScriptSnippets();
        $result = [];

        foreach ($scripts as $oneScript) {
            $serviceId = $oneScript->getServiceId();
            $result[$oneScript->getId()] = $this->getServiceById($serviceId);
        }

        return $result;
    }

    public function calculateSnippetId(string $snippetContents): string
    {
        return md5(trim($snippetContents));
    }
}
