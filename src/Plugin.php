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

namespace ShineUnited\Conductor\Addon\Twig;

use ShineUnited\Conductor\Addon\Twig\Provider\GeneratorProvider;
use ShineUnited\Conductor\Capability\GeneratorProvider as GeneratorProviderCapability;
use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Plugin\Capable;

/**
 * Composer Plugin
 */
class Plugin implements PluginInterface, Capable {

	/**
	 * {@inheritDoc}
	 */
	public function activate(Composer $composer, IOInterface $io): void {
		// do nothing
	}

	/**
	 * {@inheritDoc}
	 */
	public function deactivate(Composer $composer, IOInterface $io): void {
		// do nothing
	}

	/**
	 * {@inheritDoc}
	 */
	public function uninstall(Composer $composer, IOInterface $io): void {
		// do nothing
	}

	/**
	 * {@inheritDoc}
	 */
	public function getCapabilities() {
		return [
			GeneratorProviderCapability::class => GeneratorProvider::class
		];
	}
}
