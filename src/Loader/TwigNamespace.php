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

namespace ShineUnited\Conductor\Addon\Twig\Loader;

/**
 * Twig Namespace
 */
class TwigNamespace implements TwigNamespaceInterface {
	private ?string $name;
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
	 * {@inheritDoc}
	 */
	public function getName(): ?string {
		return $this->name;
	}

	/**
	 * {@inheritDoc}
	 */
	public function getPaths(): array {
		return $this->paths;
	}
}
