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

namespace ShineUnited\Conductor\Addon\Twig\Extension;

use ShineUnited\Conductor\Configuration\Configuration;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Symfony\Component\Filesystem\Path;

/**
 * Path Extension
 */
class PathExtension extends AbstractExtension {
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
			new TwigFunction('path', [$this, 'getPath'])
		];
	}

	/**
	 * Callback for twig 'path' function, returns requested config parameter.
	 *
	 * @param string $path     Path or config parameter name.
	 * @param string $basePath Optional base path (working dir if not defined).
	 *
	 * @return string The referenced path, relative to base path.
	 */
	public function getPath(string $path, ?string $basePath = null): string {
		if (isset($this->config[$path])) {
			$path = $this->config[$path];
		} else {
			$path = $this->config->processValue($path);
		}

		$path = Path::canonicalize($path);
		if (!Path::isAbsolute($path)) {
			$path = Path::makeAbsolute($path, $this->config['working-dir']);
		}

		if (is_null($basePath)) {
			return $path;
		}

		if (isset($this->config[$basePath])) {
			$basePath = $this->config[$basePath];
		} else {
			$basePath = $this->config->processValue($basePath);
		}

		$basePath = Path::canonicalize($basePath);
		if (!Path::isAbsolute($basePath)) {
			$basePath = Path::makeAbsolute($basePath, $this->config['working-dir']);
		}

		return Path::makeRelative(
			$path,
			$basePath
		);
	}
}
