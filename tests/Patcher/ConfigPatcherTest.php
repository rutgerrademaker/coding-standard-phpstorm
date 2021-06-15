<?php

/**
 * Copyright Youwe. All rights reserved.
 * https://www.youweagency.nl
 */

namespace Youwe\CodingStandard\PhpStorm\Tests\Patcher;

use PHPUnit\Framework\TestCase;
use Youwe\CodingStandard\PhpStorm\EnvironmentInterface;
use Youwe\CodingStandard\PhpStorm\Patcher\ConfigPatcher;
use Youwe\CodingStandard\PhpStorm\Patcher\ConfigPatcherInterface;

/**
 * @coversDefaultClass \Youwe\CodingStandard\PhpStorm\Patcher\ConfigPatcher
 */
class ConfigPatcherTest extends TestCase
{
    /**
     * @return void
     *
     * @covers ::__construct
     * @covers ::patch
     */
    public function testPatch()
    {
        $environment = $this->createMock(EnvironmentInterface::class);

        $patchers = [
            $this->createMock(ConfigPatcherInterface::class),
            $this->createMock(ConfigPatcherInterface::class),
        ];

        foreach ($patchers as $patcher) {
            $patcher
                ->expects($this->once())
                ->method('patch')
                ->with($environment);
        }

        (new ConfigPatcher($patchers))->patch($environment);
    }
}
