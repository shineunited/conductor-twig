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
 * Twig Namespace Interface
 */
interface TwigNamespaceInterface {

	/**
	 * Gets the name of the namespace.
	 *
	 * @return string The name of the namespace.
	 */
	public function getName(): ?string;

	/**
	 * Gets the namespace include paths.
	 *
	 * @return string[] List of template include paths for this namespace.
	 */
	public function getPaths(): array;
}
