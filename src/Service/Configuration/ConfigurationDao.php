<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\Service\Configuration;

use OxidProfessionalServices\Usercentrics\DataObject\Configuration;
use OxidProfessionalServices\Usercentrics\DataObject\Script;
use OxidProfessionalServices\Usercentrics\DataObject\ScriptSnippet;
use OxidProfessionalServices\Usercentrics\DataObject\Service;

final class ConfigurationDao implements ConfigurationDaoInterface
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
        $scriptsSnippets = $this->getScriptSnippetsConfiguration();
        $services = $this->getServicesConfiguration();

        return new Configuration($services, $scripts, $scriptsSnippets);
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
     * @return ScriptSnippet[]
     */
    private function getScriptSnippetsConfiguration(): array
    {
        $plainConfig = $this->storage->getData();
        $plainScripts = $this->getConfigTypeFromPlainData('scriptSnippets', $plainConfig);

        $scriptSnippets = [];
        /** @var string[] $scriptDataArray */
        foreach ($plainScripts as $scriptDataArray) {
            $scriptSnippets[] = $this->scriptSnippetFromArray($scriptDataArray);
        }

        return $scriptSnippets;
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
            $service = $this->serviceFromArray($serviceDataArray);
            $services[$service->getId()] = $service;
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
        /** @var mixed $typeConfig */
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
        $path = (string)($data['path'] ?? '');
        $service = (string)($data['service'] ?? '');

        return new Script($path, $service);
    }

    /**
     * @param mixed[] $data
     */
    private function scriptSnippetFromArray(array $data): ScriptSnippet
    {
        $id = (string)($data['id'] ?? '');
        $service = (string)($data['service'] ?? '');

        return new ScriptSnippet($id, $service);
    }

    /**
     * @param mixed[] $data
     */
    private function serviceFromArray(array $data): Service
    {
        $serviceName = (string)($data['name'] ?? '');
        $serviceId = (string)($data['id'] ?? '');

        return new Service($serviceName, $serviceId);
    }

    public function putConfiguration(Configuration $configuration): void
    {
        $plainConfig = [
            'scripts' => $this->preparePlainScriptsArray($configuration->getScripts()),
            'services' => $this->preparePlainServicesArray($configuration->getServices()),
            'scriptSnippets' => $this->preparePlainSnippetsArray($configuration->getScriptSnippets())
        ];

        $this->storage->putData($plainConfig);
    }

    /**
     * Converts array of Services to plain array for further saving
     *
     * @param Script[] $scripts
     *
     * @return mixed[]
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
     * @return mixed[]
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

    /**
     * Converts array of Services to plain array for further saving
     *
     * @param ScriptSnippet[] $snippets
     *
     * @return mixed[]
     */
    private function preparePlainSnippetsArray(array $snippets): array
    {
        $plainSnippets = [];

        foreach ($snippets as $snippet) {
            $plainSnippets[] = [
                'service' => $snippet->getServiceId(),
                'id' => $snippet->getId()
            ];
        }

        return $plainSnippets;
    }
}
