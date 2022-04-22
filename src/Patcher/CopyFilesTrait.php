<?php

/**
 * Copyright Youwe. All rights reserved.
 * https://www.youweagency.com
 */

declare(strict_types=1);

namespace Youwe\CodingStandard\PhpStorm\Patcher;

use Youwe\CodingStandard\PhpStorm\FilesystemInterface;
use Youwe\CodingStandard\PhpStorm\ProjectTypeResolver;

trait CopyFilesTrait
{
    /**
     * Copy a directory.
     *
     * @param FilesystemInterface $source
     * @param FilesystemInterface $destination
     * @param string              $path
     * @param string              $type
     *
     * @return void
     */
    private function copyDirectory(
        FilesystemInterface $source,
        FilesystemInterface $destination,
        string $path,
        string $type = ProjectTypeResolver::DEFAULT_PROJECT_TYPE
    ): void {
        foreach ($source->listFiles($type . DIRECTORY_SEPARATOR . $path) as $filePath) {
            $this->copyFile($source, $destination, $filePath);
        }
    }

    /**
     * Copy a file.
     *
     * @param FilesystemInterface $source
     * @param FilesystemInterface $destination
     * @param string              $path
     * @param string              $type
     *
     * @return void
     */
    private function copyFile(
        FilesystemInterface $source,
        FilesystemInterface $destination,
        string $path,
        string $type = ProjectTypeResolver::DEFAULT_PROJECT_TYPE
    ): void {
        $projectPath = $type . DIRECTORY_SEPARATOR . $path;

        $destination->put(
            $projectPath,
            $source->read($projectPath)
        );
    }
}
