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

namespace ShineUnited\Conductor\Addon\Twig\Tests\Loader;

use ShineUnited\Conductor\Addon\Twig\Tests\TestCase;
use ShineUnited\Conductor\Addon\Twig\Loader\TwigNamespace;
use ShineUnited\Conductor\Addon\Twig\Loader\TwigNamespaceInterface;

/**
 * Twig Namespace Test
 */
class TwigNamespaceTest extends TestCase {

	/**
	 * @return void
	 */
	public function testConstructor(): void {
		$namespace = new TwigNamespace();

		$this->assertInstanceOf(TwigNamespaceInterface::class, $namespace);
	}

	/**
	 * @return void
	 */
	public function testGetName(): void {
		$names = [
			'name1',
			'name2',
			'name3',
			'myTestName',
			'AnotherTestName',
			'ALLCAPSNAME'
		];

		foreach ($names as $name) {
			$namespace = new TwigNamespace([], $name);

			$this->assertSame($name, $namespace->getName());
		}
	}

	/**
	 * @return void
	 */
	public function testGetPaths(): void {
		$pathsets = [
			'/path/to/templates1',
			'another/path/to/templates',
			['path1', 'path2'],
			['path1', 'path2', 'path3']
		];

		foreach ($pathsets as $pathset) {
			$namespace = new TwigNamespace($pathset);

			if (is_array($pathset)) {
				$this->assertSame($pathset, $namespace->getPaths());
			} else {
				$this->assertSame([$pathset], $namespace->getPaths());
			}
		}
	}
}
