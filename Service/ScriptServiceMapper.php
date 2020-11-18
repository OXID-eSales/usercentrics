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
     * @var array<string,?Service>
     */
    private $scriptsByPath;

    public function __construct(ConfigurationDaoInterface $configurationDao)
    {
        $this->configurationDao = $configurationDao;
        $this->scriptsByPath = $this->getScriptsByPath();
    }

    /**
     * @param string $pathOrUrl
     * @return bool
     */
    public function isScriptWhitelisted(string $pathOrUrl): bool
    {
        $scriptsByPath = $this->scriptsByPath;
        return !isset($scriptsByPath[$pathOrUrl]);
    }

    /**
     * Get linked script Service
     */
    public function scriptService(string $pathOrUrl): ?Service
    {
        $scriptsByPath = $this->scriptsByPath;
        return isset($scriptsByPath[$pathOrUrl]) ? $scriptsByPath[$pathOrUrl] : null;
    }

    /**
     * @param string $snippet
     * @return bool
     * @throws Exception
     */
    public function isSnippetWhitelisted(string $snippet): bool
    {
        //fixme: do implement this
        throw new Exception("not yet implemented");
    }

    /**
     * @return array<string,?Service>
     */
    protected function getScriptsByPath(): array
    {
        $config = $this->configurationDao->getConfiguration();
        $scripts = $config->getScripts();
        $services = $config->getServices();
        /**
         * create dictionary for services
         * @var array<string, Service>
         */
        $servicesById = array_reduce(
            $services,
            /**
             * @param array<string,Service> $result
             * @param Service $item
             * @return array<string,Service>
             */
            function (array &$result, Service $item) {
                $result[$item->getId()] = $item;
                return $result;
            },
            []
        );


        return array_reduce(
            $scripts,
            /**
             * @param array<string,?Service> $result
             * @param Script $item
             * @return array<string,?Service>
             */
            function (array &$result, Script $item) use ($servicesById) {
                $result[$item->getPath()] = isset($servicesById[$item->getServiceId()]) ?
                    $servicesById[$item->getServiceId()] : null;
                return $result;
            },
            []
        );
    }
}
