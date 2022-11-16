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

namespace ShineUnited\Conductor\Addon\Twig\Twig;

use ShineUnited\Conductor\Configuration\Configuration;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Config Extension
 */
class ConfigExtension extends AbstractExtension {
	private Configuration $config;

	/**
	 * Initializes the extension.
	 *
	 * @param Configuration $config Conductor configuration.
	 */
	public function __construct(Configuration $config) {
		$this->config = $config;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getGlobals(): array {
		return [
			'config' => $this->config
		];
	}

	/**
	 * {@inheritDoc}
	 */
	public function getFunctions(): array {
		return [
			new TwigFunction('config', [$this, 'getConfig'])
		];
	}

	/**
	 * Callback for twig 'config' function, returns requested config parameter.
	 *
	 * @param string $name Config parameter name.
	 *
	 * @return mixed The value of the parameter.
	 */
	public function getConfig(string $name): mixed {
		return $this->config[$name];
	}
}
