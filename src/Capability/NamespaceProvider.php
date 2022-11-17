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

namespace ShineUnited\Conductor\Addon\Twig\Capability;

use ShineUnited\Conductor\Addon\Twig\Loader\TwigNamespaceInterface;
use Composer\Plugin\Capability\Capability;

/**
 * Namespace Provider Interface
 *
 * This capability will receive an array with 'config' key as constructor
 * argument. This contains a ShineUnited\Conductor\Configuration\Configuration
 * instance. It also contains a 'plugin' key containing the plugin instance that
 * created the capability.
 */
interface NamespaceProvider extends Capability {

	/**
	 * Retrieves an array of twig namespaces
	 *
	 * @return TwigNamespaceInterface[]
	 */
	public function getNamespaces(): array;
}
