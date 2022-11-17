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

/**
 * Get Globals Trait
 */
trait GetGlobalsTrait {

	/**
	 * @return string Class of the extension.
	 */
	abstract protected function getExtensionClass(): string;

	/**
	 * @return string[] Class of the extension.
	 */
	abstract protected function getExpectedGlobals(): array;

	/**
	 * @return Configuration Configuration mock object.
	 */
	abstract protected function createConfigurationMock(): Configuration;

	/**
	 * @return void
	 */
	public function testGetGlobals(): void {
		$extensionClass = $this->getExtensionClass();
		$expectedGlobals = $this->getExpectedGlobals();

		$config = $this->createConfigurationMock();

		$extension = new $extensionClass($config);

		$returnedGlobals = $extension->getGlobals();

		foreach ($returnedGlobals as $key => $value) {
			$this->assertArrayHasKey($key, $expectedGlobals);

			$type = null;
			if (isset($expectedGlobals[$key])) {
				$type = $expectedGlobals[$key];
			}

			if ($type == 'array') {
				$this->assertIsArray($value);
			} elseif ($type == 'bool') {
				$this->assertIsBool($value);
			} elseif ($type == 'callable') {
				$this->assertIsCallable($value);
			} elseif ($type == 'float') {
				$this->assertIsFloat($value);
			} elseif ($type == 'int') {
				$this->assertIsInt($value);
			} elseif ($type == 'numeric') {
				$this->assertIsNumeric($value);
			} elseif ($type == 'iterable') {
				$this->assertIsIterable($value);
			} elseif ($type == 'object') {
				$this->assertIsObject($value);
			} elseif ($type == 'resource') {
				$this->assertIsResource($value);
			} elseif ($type == 'scalar') {
				$this->assertIsScalar($value);
			} elseif ($type == 'string') {
				$this->assertIsString($value);
			} elseif (class_exists($type)) {
				$this->assertInstanceOf($type, $value);
			} else {
				$this->assertTrue(false, 'Invalid/Missing Type');
			}
		}

		foreach ($expectedGlobals as $key => $type) {
			$this->assertArrayHasKey($key, $returnedGlobals);
		}
	}
}
