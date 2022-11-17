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

namespace ShineUnited\Conductor\Addon\Twig\Tests\Blueprint;

use ShineUnited\Conductor\Addon\Twig\Tests\TestCase;
use ShineUnited\Conductor\Addon\Twig\Blueprint\TwigBlueprint;
use ShineUnited\Conductor\Filesystem\Blueprint\BlueprintInterface;

/**
 * Twig Blueprint Test
 */
class TwigBlueprintTest extends TestCase {

	/**
	 * @return void
	 */
	public function testConstructor(): void {
		$blueprint = new TwigBlueprint('path', 'template', []);

		$this->assertInstanceOf(BlueprintInterface::class, $blueprint);
	}

	/**
	 * @return void
	 */
	public function testGetTemplate(): void {
		$templates = [
			'string.template',
			'path/to/template',
			'@namespaced/template',
			function () {
				return 'my/template';
			}
		];

		foreach ($templates as $template) {
			$blueprint = new TwigBlueprint('path', $template, []);
			$this->assertSame($template, $blueprint->getTemplate());
		}
	}

	/**
	 * @return void
	 */
	public function testGetContext(): void {
		$contexts = [
			[
				'var1' => 'val1',
				'var2' => 'val2',
				'var3' => 'val3'
			],
			[
				'bool'  => true,
				'int'   => 12,
				'float' => 12.23
			]
		];

		foreach ($contexts as $context) {
			$blueprint = new TwigBlueprint('path', 'template', $context);
			$this->assertSame($context, $blueprint->getContext());
		}
	}
}
