<?php

/**
 * Copyright Youwe. All rights reserved.
 * https://www.youweagency.com
 */

declare(strict_types=1);

namespace Youwe\CodingStandard\PhpStorm;

use Composer\Composer;

/**
 * Resolves the project type.
 */
class ProjectTypeResolver
{
    /**
     * The key from the composer configuration which contains other configuration.
     */
    public const COMPOSER_CONFIG_KEY = 'youwe-testing-suite';

    /**
     * The key in the configuration, which determines the overwrite for the type.
     */
    public const COMPOSER_CONFIG_TYPE_KEY = 'type';

    /** @var Composer */
    private $composer;

    /** @var array */
    private $mapping = [
        'magento2-module' => 'magento2',
        'magento-module'  => 'magento1',
        'magento2-project' => 'magento2',
        'magento-project' => 'magento2',
        'alumio-project'  => 'alumio',
        'laravel-project' => 'laravel',
    ];

    public const DEFAULT_PROJECT_TYPE = 'default';

    /**
     * Constructor.
     *
     * @param Composer   $composer
     * @param array|null $mapping
     */
    public function __construct(Composer $composer)
    {
        $this->composer = $composer;
        $this->mapping  = $mapping ?? $this->mapping;
    }

    /**
     * Get the type.
     *
     * @return string
     */
    public function resolve(): string
    {
        $config = $this->composer->getConfig();

        if ($config->has(static::COMPOSER_CONFIG_KEY)) {
            $configNode = $config->get(static::COMPOSER_CONFIG_KEY);
            if (isset($configNode[static::COMPOSER_CONFIG_TYPE_KEY])) {
                return $configNode[static::COMPOSER_CONFIG_TYPE_KEY];
            }
        }

        $packageType = $this->composer->getPackage()->getType();

        return array_key_exists($packageType, $this->mapping)
            ? $this->mapping[$packageType]
            : self::DEFAULT_PROJECT_TYPE;
    }
}
