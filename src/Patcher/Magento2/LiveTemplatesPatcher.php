<?php

/**
 * Copyright Youwe. All rights reserved.
 * https://www.youweagency.com
 */

declare(strict_types=1);

namespace Youwe\CodingStandard\PhpStorm\Patcher\Magento2;

use Youwe\CodingStandard\PhpStorm\EnvironmentInterface;
use Youwe\CodingStandard\PhpStorm\Patcher\ConfigPatcherInterface;
use Youwe\CodingStandard\PhpStorm\Patcher\CopyFilesTrait;

class LiveTemplatesPatcher implements ConfigPatcherInterface
{
    use CopyFilesTrait;

    /**
     * Patch the config.
     *
     * @param EnvironmentInterface $environment
     *
     * @return void
     */
    public function patch(
        EnvironmentInterface $environment
    ): void {

        if (!empty($environment->getIdeDefaultConfigFilesystem()->getRoot())) {
            $this->copyDirectory(
                $environment->getDefaultsFilesystem(),
                $environment->getIdeDefaultConfigFilesystem(),
                $environment->getProjectTypeResolver()->resolve() . DIRECTORY_SEPARATOR . 'templates'
            );
        }
    }
}
