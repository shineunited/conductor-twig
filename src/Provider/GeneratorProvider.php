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

namespace ShineUnited\Conductor\Addon\Twig\Provider;

use ShineUnited\Conductor\Addon\Twig\Generator\TwigGenerator;
use ShineUnited\Conductor\Capability\GeneratorProvider as GeneratorProviderCapability;

/**
 * Generator Provider
 */
class GeneratorProvider implements GeneratorProviderCapability {

	/**
	 * {@inheritDoc}
	 */
	public function getGenerators(): array {
		return [
			new TwigGenerator()
		];
	}
}
