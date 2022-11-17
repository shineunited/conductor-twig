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

namespace ShineUnited\Conductor\Addon\Twig\Tests;

use ShineUnited\Conductor\Addon\Twig\Plugin;
use ShineUnited\Conductor\Addon\Twig\Provider\GeneratorProvider;
use ShineUnited\Conductor\Capability\GeneratorProvider as GeneratorProviderCapability;
use Composer\Plugin\PluginInterface;
use Composer\Plugin\Capable;

/**
 * Base Test Case
 */
class PluginTest extends TestCase {

	/**
	 * @return void
	 */
	public function testGetCapabilities(): void {
		$classmap = [
			GeneratorProviderCapability::class => GeneratorProvider::class
		];

		$plugin = new Plugin();
		$this->assertInstanceOf(PluginInterface::class, $plugin);
		$this->assertInstanceOf(Capable::class, $plugin);

		$capabilities = $plugin->getCapabilities();
		$this->assertIsArray($capabilities);

		foreach ($classmap as $capability => $provider) {
			$this->assertArrayHasKey($capability, $capabilities);
			$this->assertEquals($provider, $capabilities[$capability]);
		}
	}
}
