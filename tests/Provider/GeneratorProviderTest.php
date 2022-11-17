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

namespace ShineUnited\Conductor\Addon\Twig\Tests\Provider;

use ShineUnited\Conductor\Addon\Twig\Provider\GeneratorProvider;
use ShineUnited\Conductor\Capability\GeneratorProvider as GeneratorProviderCapability;
use ShineUnited\Conductor\Filesystem\Generator\GeneratorInterface;

/**
 * Generator Provider Test
 */
class GeneratorProviderTest extends ProviderTestCase {

	/**
	 * {@inheritDoc}
	 */
	protected function getProviderClass(): string {
		return GeneratorProvider::class;
	}

	/**
	 * {@inheritDoc}
	 */
	protected function getProviderInterface(): string {
		return GeneratorProviderCapability::class;
	}

	/**
	 * {@inheritDoc}
	 */
	protected function getProviderMethod(): string {
		return 'getGenerators';
	}

	/**
	 * {@inheritDoc}
	 */
	protected function getObjectInterface(): string {
		return GeneratorInterface::class;
	}
}
