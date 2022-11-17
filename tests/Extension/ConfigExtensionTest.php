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

use ShineUnited\Conductor\Addon\Twig\Extension\ConfigExtension;
use ShineUnited\Conductor\Configuration\Configuration;

/**
 * Config Extension Test
 */
class ConfigExtensionTest extends ExtensionTestCase {
	use Traits\GetFunctionsTrait;
	use Traits\GetGlobalsTrait;

	/**
	 * @return string Class of the extension.
	 */
	protected function getExtensionClass(): string {
		return ConfigExtension::class;
	}

	/**
	 * {@inheritDoc}
	 */
	protected function getExpectedFunctions(): array {
		return [
			'config' => 'getConfig'
		];
	}

	/**
	 * {@inheritDoc}
	 */
	protected function getExpectedGlobals(): array {
		return [
			'config' => Configuration::class
		];
	}

	/**
	 * @return void
	 */
	public function testGetConfig(): void {
		$values = [
			'string'  => 'foobar',
			'boolean' => false,
			'integer' => 12,
			'float'   => 12.34
		];

		$config = $this->createConfigurationMock($values);
		$extension = new ConfigExtension($config);

		foreach ($values as $key => $value) {
			$this->assertSame($value, $extension->getConfig($key));
		}
	}
}
