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
use ShineUnited\Conductor\Addon\Twig\Generator\TwigGenerator;
use ShineUnited\Conductor\Filesystem\Generator\GeneratorInterface;

/**
 * Twig Generator Test
 */
class TwigGeneratorTest extends TestCase {

	/**
	 * @return void
	 */
	public function testHandlesType(): void {
		$generator = new TwigGenerator();

		$this->assertInstanceOf(GeneratorInterface::class, $generator);

		$this->assertTrue($generator->handlesType(TwigGenerator::TYPE));
		$this->assertFalse($generator->handlesType(TwigGenerator::TYPE . '-invalid'));
	}

	/**
	 * @return void
	 */
	public function testGenerateContents(): void {
		$this->toDo();
	}
}
