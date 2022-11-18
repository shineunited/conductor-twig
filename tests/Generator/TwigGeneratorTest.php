<?php

/**
 * This file is part of Conductor Twig Addon.
 *
 * (c) Shine United LLC
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace ShineUnited\Conductor\Addon\Twig\Tests\Generator;

use ShineUnited\Conductor\Addon\Twig\Tests\TestCase;
use ShineUnited\Conductor\Addon\Twig\Blueprint\TwigBlueprintInterface;
use ShineUnited\Conductor\Addon\Twig\Generator\TwigGenerator;
use ShineUnited\Conductor\Filesystem\Blueprint\BlueprintInterface;
use ShineUnited\Conductor\Filesystem\Blueprint\FileBlueprintInterface;
use ShineUnited\Conductor\Filesystem\Generator\GeneratorInterface;

/**
 * Twig Generator Test
 */
class TwigGeneratorTest extends TestCase {

	/**
	 * @return void
	 */
	public function testHandlesBlueprint(): void {
		$generator = new TwigGenerator();

		$twigBlueprint = $this->createStub(TwigBlueprintInterface::class);
		$genericBlueprint = $this->createStub(BlueprintInterface::class);
		$fileBlueprint = $this->createStub(FileBlueprintInterface::class);

		$this->assertTrue($generator->handlesBlueprint($twigBlueprint));
		$this->assertFalse($generator->handlesBlueprint($genericBlueprint));
		$this->assertFalse($generator->handlesBlueprint($fileBlueprint));
	}

	/**
	 * @return void
	 */
	public function testGenerateContents(): void {
		$this->toDo();
	}
}
