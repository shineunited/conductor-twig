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

/**
 * Twig Namespace
 */
class TwigNamespace {
	private string $name;
	private array $paths;

	/**
	 * Initializes the namespace.
	 *
	 * @param array|string $paths One or more paths to template directories.
	 * @param string       $name  The namespace name, NULL if default.
	 */
	public function __construct(array|string $paths = [], ?string $name = null) {
		if (is_string($paths)) {
			$this->paths = [$paths];
		} else {
			$this->paths = $paths;
		}

		$this->name = $name;
	}

	/**
	 * Gets the name of the namespace.
	 *
	 * @return string The name of the namespace.
	 */
	public function getName(): ?string {
		return $this->name;
	}

	/**
	 * Gets the namespace include paths.
	 *
	 * @return string[] List of template include paths for this namespace.
	 */
	public function getPaths(): array {
		return $this->paths;
	}
}
