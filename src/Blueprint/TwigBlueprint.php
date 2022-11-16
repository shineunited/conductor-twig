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

use ShineUnited\Conductor\Addon\Twig\Generator\TwigGenerator;
use ShineUnited\Conductor\Filesystem\Blueprint\BaseBlueprint;

/**
 * Twig Blueprint
 */
class TwigBlueprint extends BaseBlueprint {
	private mixed $template;
	private array $context;

	/**
	 * Initializes the blueprint.
	 *
	 * @param string|callable $path        Output path.
	 * @param string|callable $template    Template name.
	 * @param mixed[]         $context     Twig context.
	 * @param string          $allowCreate Allow create.
	 * @param string          $allowUpdate Allow update.
	 */
	public function __construct(
		string|callable $path,
		string|callable $template,
		array $context = [],
		?string $allowCreate = null,
		?string $allowUpdate = null
	) {
		parent::__construct(TwigGenerator::TYPE, $path, $allowCreate, $allowUpdate);

		$this->template = $template;
		$this->context = $context;
	}

	/**
	 * Get the template name.
	 *
	 * @return string|callable Template name, expects to be processed.
	 */
	public function getTemplate(): string|callable {
		return $this->template;
	}

	/**
	 * Get the twig context.
	 *
	 * @return mixed[] Twig context, expects to be processed.
	 */
	public function getContext(): array {
		return $this->context;
	}
}
