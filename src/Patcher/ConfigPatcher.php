<?php

/**
 * Copyright Youwe. All rights reserved.
 * https://www.youweagency.com
 */

declare(strict_types=1);

namespace Youwe\CodingStandard\PhpStorm\Patcher;

use Youwe\CodingStandard\PhpStorm\EnvironmentInterface;
use Youwe\CodingStandard\PhpStorm\Patcher\Magento2\FileTemplatesPatcher as FileTemplatesPatcherMagento2;
use Youwe\CodingStandard\PhpStorm\Patcher\Magento2\LiveTemplatesPatcher;
use Youwe\CodingStandard\PhpStorm\Patcher\Magento2\TemplateSettingsPatcher;
use Youwe\CodingStandard\PhpStorm\XmlAccessor;

class ConfigPatcher implements ConfigPatcherInterface
{
    /**
     * @var ConfigPatcherInterface[]
     */
    private $patchers;

    /**
     * Constructor.
     *
     * @param array $patchers
     */
    public function __construct(array $patchers = null)
    {
        $xmlAccessor = new XmlAccessor();

        $this->patchers = $patchers !== null
            ? $patchers
            : [
                'default' => [
                    new CodeStylePatcher(),
                    new FileTemplatesPatcher($xmlAccessor),
                    new InspectionsPatcher($xmlAccessor)
                ],
                'magento2' => [
                    new FileTemplatesPatcherMagento2(),
                    new TemplateSettingsPatcher($xmlAccessor),
                    new LiveTemplatesPatcher()
                ]
            ];
    }

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
        foreach ($this->patchers as $projectType => $patcher) {
            if ($environment->getProjectTypeResolver()->resolve() === $projectType) {
                $patcher->patch($environment);
            } elseif ($projectType === 'default') {
                /**
                 * Patches that are default are configured for all projects.
                 * TODO:: Add function to overwrite default patches.
                 **/
                $patcher->patch($environment);
            }
        }
    }
}
