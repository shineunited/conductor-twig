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

namespace ShineUnited\Conductor\Addon\Twig\Tests\Extension\Traits;

use ShineUnited\Conductor\Configuration\Configuration;
use Twig\TwigFunction;

/**
 * Get Functions Trait
 */
trait GetFunctionsTrait {

	/**
	 * @return string Class of the extension.
	 */
	abstract protected function getExtensionClass(): string;

	/**
	 * @return string[] Expected functions.
	 */
	abstract protected function getExpectedFunctions(): array;

	/**
	 * @return Configuration Configuration mock object.
	 */
	abstract protected function createConfigurationMock(): Configuration;

	/**
	 * @return void
	 */
	public function testGetFunctions(): void {
		$extensionClass = $this->getExtensionClass();
		$expectedFunctions = $this->getExpectedFunctions();

		$config = $this->createConfigurationMock();

		$extension = new $extensionClass($config);

		$returnedFunctions = $extension->getFunctions();
		$returnedFunctionNames = [];
		foreach ($returnedFunctions as $function) {
			$this->assertInstanceOf(TwigFunction::class, $function);
			$this->assertArrayHasKey($function->getName(), $expectedFunctions);

			$method = false;
			if (isset($expectedFunctions[$function->getName()])) {
				$method = $expectedFunctions[$function->getName()];
			}
			$this->assertSame([$extension, $method], $function->getCallable());

			$returnedFunctionNames[] = $function->getName();
		}

		foreach ($expectedFunctions as $key => $method) {
			$this->assertContains($key, $returnedFunctionNames);
		}
	}
}
