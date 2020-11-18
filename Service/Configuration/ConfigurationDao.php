<?php

declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\Service\Configuration;

use OxidProfessionalServices\Usercentrics\DataObject\Configuration;
use OxidProfessionalServices\Usercentrics\DataObject\Script;
use OxidProfessionalServices\Usercentrics\DataObject\Service;

/***
 * Class Configuration
 * @package OxidProfessionalServices\Usercentrics\Core
 */
class ConfigurationDao implements ConfigurationDaoInterface
{
    /** @var StorageInterface */
    private $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @return Configuration
     */
    public function getConfiguration(): Configuration
    {
        $scripts = $this->getScriptsConfiguration();
        $services = $this->getServicesConfiguration();

        return new Configuration($scripts, $services);
    }

    /**
     * @return Script[]
     */
    private function getScriptsConfiguration(): array
    {
        $plainConfig = $this->storage->getData();
        $plainScripts = $this->getConfigTypeFromPlainData('scripts', $plainConfig);

        $scripts = [];
        /** @var string[] $scriptDataArray */
        foreach ($plainScripts as $scriptDataArray) {
            $scripts[] = $this->scriptFromArray($scriptDataArray);
        }

        return $scripts;
    }

    /**
     * @return Service[]
     */
    private function getServicesConfiguration(): array
    {
        $plainConfig = $this->storage->getData();
        $plainServices = $this->getConfigTypeFromPlainData('services', $plainConfig);

        $services = [];
        /** @var string[] $serviceDataArray */
        foreach ($plainServices as $serviceDataArray) {
            $services[] = $this->serviceFromArray($serviceDataArray);
        }

        return $services;
    }

    /**
     * @param string $typeOfList its a key - scripts|services
     * @param mixed[] $plainConfig
     *
     * @return mixed[]
     */
    private function getConfigTypeFromPlainData(string $typeOfList, array $plainConfig): array
    {
        $typeConfig = $plainConfig[$typeOfList] ?? [];

        if (!is_array($typeConfig)) {
            $typeConfig = [];
        }

        return $typeConfig;
    }

    /**
     * @param mixed[] $data
     */
    private function scriptFromArray(array $data): Script
    {
        $path = $data['path'] ?? "";
        $service = $data['service'] ?? "";
        return new Script((string)$path, (string)$service);
    }

    /**
     * @param mixed[] $data
     */
    private function serviceFromArray(array $data): Service
    {
        $serviceName = $data['name'] ?? "";
        $serviceId = $data['id'] ?? "";
        return new Service((string)$serviceName, (string)$serviceId);
    }

    public function putConfiguration(Configuration $configuration): void
    {
        $plainConfig = [
            'scripts' => $this->preparePlainScriptsArray($configuration->getScripts()),
            'services' => $this->preparePlainServicesArray($configuration->getServices())
        ];

        $this->storage->putData($plainConfig);
    }

    /**
     * Converts array of Services to plain array for further saving
     *
     * @param Script[] $scripts
     *
     * @return array
     */
    private function preparePlainScriptsArray(array $scripts): array
    {
        $plainScripts = [];

        foreach ($scripts as $script) {
            $plainScripts[] = [
                'service' => $script->getServiceId(),
                'path' => $script->getPath()
            ];
        }

        return $plainScripts;
    }

    /**
     * Converts array of Services to plain array for further saving
     *
     * @param Service[] $services
     *
     * @return array
     */
    private function preparePlainServicesArray(array $services): array
    {
        $plainServices = [];

        foreach ($services as $service) {
            $plainServices[] = [
                'name' => $service->getName(),
                'id' => $service->getId()
            ];
        }

        return $plainServices;
    }
}
