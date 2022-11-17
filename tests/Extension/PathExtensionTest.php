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

namespace ShineUnited\Conductor\Addon\Twig\Tests\Extension;

use ShineUnited\Conductor\Addon\Twig\Extension\PathExtension;

/**
 * Config Extension Test
 */
class PathExtensionTest extends ExtensionTestCase {
	use Traits\GetFunctionsTrait;

	/**
	 * @return string Class of the extension.
	 */
	protected function getExtensionClass(): string {
		return PathExtension::class;
	}

	/**
	 * {@inheritDoc}
	 */
	protected function getExpectedFunctions(): array {
		return [
			'path' => 'getPath'
		];
	}

	/**
	 * @return void
	 */
	public function testGetPath(): void {
		$workingDir = '/test';

		$absolutePaths = [
			'abspath1' => $workingDir . '/this/is/an/absolute/path',
			'abspath2' => $workingDir . '/this/is/a/different/path'
		];

		$relativePaths = [
			'relpath1' => 'relative/path1',
			'relpath2' => 'relative/path2'
		];

		$values = array_merge(['working-dir' => $workingDir], $absolutePaths, $relativePaths);

		$config = $this->createConfigurationMock($values);
		$extension = new PathExtension($config);

		$tests = [
			[
				'path'     => 'relpath1',
				'basePath' => null,
				'result'   => '/test/relative/path1'
			],
			[
				'path'     => 'relpath1',
				'basePath' => 'working-dir',
				'result'   => 'relative/path1'
			],
			[
				'path'     => 'relpath2',
				'basePath' => 'relpath1',
				'result'   => '../path2'
			],
			[
				'path'     => 'abspath1',
				'basePath' => 'abspath2',
				'result'   => '../../../an/absolute/path'
			],
			[
				'path'     => 'relpath1',
				'basePath' => 'abspath2',
				'result'   => '../../../../../relative/path1'
			],
			[
				'path'     => 'abspath2',
				'basePath' => 'relpath1',
				'result'   => '../../this/is/a/different/path'
			],
			[
				'path'     => 'abspath2',
				'basePath' => '/test/this/is/an',
				'result'   => '../a/different/path'
			],
		];

		foreach ($tests as $test) {
			$this->assertEquals($test['result'], $extension->getPath($test['path'], $test['basePath']));
		}
	}
}
