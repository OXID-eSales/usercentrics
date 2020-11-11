<?php


namespace OxidProfessionalServices\Usercentrics\Service;

use Exception;
use OxidProfessionalServices\Usercentrics\DataObject\Script;
use OxidProfessionalServices\Usercentrics\DataObject\Service;

class Repository implements RepositoryInterface
{
    /**
     * @var ConfigurationAccessInterface
     */
    private $configService;

    /**
     * @var array<string,?Service>
     */
    private $scriptsByPath;

    public function __construct(ConfigurationAccessInterface $configService)
    {
        $this->configService = $configService;
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
        $config = $this->configService->getConfiguration();
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
