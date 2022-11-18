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

namespace ShineUnited\Conductor\Addon\Twig\Blueprint;

use ShineUnited\Conductor\Filesystem\Blueprint\BlueprintInterface;

/**
 * Twig Blueprint Interface
 */
interface TwigBlueprintInterface extends BlueprintInterface {

	/**
	 * Get the template name.
	 *
	 * @return string|callable Template name, expects to be processed.
	 */
	public function getTemplate(): string|callable;

	/**
	 * Get the twig context.
	 *
	 * @return mixed[] Twig context, expects to be processed.
	 */
	public function getContext(): array;
}
