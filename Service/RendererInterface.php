<?php

declare(strict_types=1);

namespace OxidProfessionalServices\Usercentrics\Service;

interface RendererInterface
{
    /**
     * Form output for includes.
     *
     * @param array  $includes String files to include.
     * @param string $widget   Widget name.
     *
     * @return string
     */
    public function formFilesOutput(array $includes, string $widget): string;
}
