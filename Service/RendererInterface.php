<?php

declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\Service;

interface RendererInterface
{
    /**
     * Form output for includes.
     *
     * @param array<int,array<string>> $pathGroups // [ 10 => ["test.js","test2.js"] ]
     * @param string $widget   Widget name.
     *
     * @return string
     */
    public function formFilesOutput(array $pathGroups, string $widget): string;
}
