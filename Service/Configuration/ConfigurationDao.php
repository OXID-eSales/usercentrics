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
        $plainConfig = $this->storage->getData();

        $plainScripts = isset($plainConfig['scripts']) ? $plainConfig['scripts'] : [];
        if (! is_array($plainScripts)) {
            $plainScripts = [];
        }

        $scripts = [];
        foreach ($plainScripts as $script) {
            $script['path'] = $script['path'] ?? "";
            $script['service'] = $script['service'] ?? "";
            $scripts[] = new Script((string) $script['path'], (string) $script['service']);
        }

        $plainServices = isset($plainConfig['services']) ? $plainConfig['services'] : [];
        if (! is_array($plainServices)) {
            $plainServices = [];
        }

        $services = [];
        foreach ($plainServices as $service) {
            $service['name'] = $service['name']  ?? "";
            $service['id'] = $service['id'] ?? "";
            $services[] = new Service((string) $service['name'], (string) $service['id']);
        }
        return new Configuration($scripts, $services);
    }

    public function putConfiguration(Configuration $configuration): void
    {
        $scripts = $configuration->getScripts();
        $plainScripts = [];
        foreach ($scripts as $script) {
            $plainScripts[] = [
                'service' => $script->getServiceId(),
                'path' => $script->getPath()
            ];
        }
        $plainServices = [];
        $services = $configuration->getServices();
        foreach ($services as $service) {
            $plainServices[] = [
                'name' => $service->getName(),
                'id' => $service->getId()
            ];
        }

        $plainConfig = [
            'scripts' => $plainScripts,
            'services' => $plainServices
        ];

        $this->storage->putData($plainConfig);
    }
}
