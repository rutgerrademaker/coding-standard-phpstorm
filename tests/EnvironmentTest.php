<?php

/**
 * Copyright Youwe. All rights reserved.
 * https://www.youweagency.com
 */

declare(strict_types=1);

namespace Youwe\CodingStandard\PhpStorm\Tests;

use Composer\Composer;
use Composer\IO\IOInterface;
use Youwe\CodingStandard\PhpStorm\FilesystemInterface;
use PHPUnit\Framework\TestCase;
use Youwe\CodingStandard\PhpStorm\Environment;
use Youwe\CodingStandard\PhpStorm\ProjectTypeResolver;

/**
 * @coversDefaultClass \Youwe\CodingStandard\PhpStorm\Environment
 */
class EnvironmentTest extends TestCase
{
    /**
     * @return void
     *
     * @covers ::__construct
     * @covers ::getIdeConfigFilesystem
     * @covers ::getDefaultsFilesystem
     * @covers ::getInputOutput
     * @covers ::getComposer
     */
    public function testAccess()
    {
        $ideConfigFs  = $this->createMock(FilesystemInterface::class);
        $ideDefaultFs = $this->createMock(FilesystemInterface::class);
        $defaultsFs   = $this->createMock(FilesystemInterface::class);
        $projectFs    = $this->createMock(FilesystemInterface::class);
        $inputOutput  = $this->createMock(IOInterface::class);
        $composer     = $this->createMock(Composer::class);
        $projectTypeResolver = $this->createMock(ProjectTypeResolver::class);

        $environment = new Environment(
            $ideConfigFs,
            $ideDefaultFs,
            $defaultsFs,
            $projectFs,
            $inputOutput,
            $composer,
            $projectTypeResolver
        );

        $this->assertSame($ideConfigFs, $environment->getIdeConfigFilesystem());
        $this->assertSame($ideDefaultFs, $environment->getIdeDefaultConfigFilesystem());
        $this->assertSame($defaultsFs, $environment->getDefaultsFilesystem());
        $this->assertSame($projectFs, $environment->getProjectFilesystem());
        $this->assertSame($inputOutput, $environment->getInputOutput());
        $this->assertSame($composer, $environment->getComposer());
        $this->assertSame($projectTypeResolver, $environment->getProjectTypeResolver());
    }
}
