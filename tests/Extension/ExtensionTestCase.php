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

namespace ShineUnited\Conductor\Addon\Twig\Tests\Extension;

use ShineUnited\Conductor\Addon\Twig\Tests\TestCase;
use ShineUnited\Conductor\Configuration\Configuration;
use Twig\Extension\ExtensionInterface;

/**
 * Base Extension Test Case
 */
abstract class ExtensionTestCase extends TestCase {

	/**
	 * @return string Class of the extension.
	 */
	abstract protected function getExtensionClass(): string;

	/**
	 * @param mixed[] $values Values to seed configuration with.
	 *
	 * @return Configuration Configuration mock object.
	 */
	protected function createConfigurationMock(array $values = []): Configuration {
		$builder = $this->getMockBuilder(Configuration::class);
		$builder->disableOriginalConstructor();
		$mock = $builder->getMock();

		$offsetGet = $mock->expects($this->any());
		$offsetGet->method('offsetGet');
		$offsetGet->will($this->returnCallback(function ($offset) use ($values) {
			return $values[$offset];
		}));

		$offsetExists = $mock->expects($this->any());
		$offsetExists->method('offsetExists');
		$offsetExists->will($this->returnCallback(function ($offset) use ($values) {
			return isset($values[$offset]);
		}));

		$processValue = $mock->expects($this->any());
		$processValue->method('processValue');
		$processValue->will($this->returnCallback(function ($value) {
			return $value;
		}));

		return $mock;
	}

	/**
	 * @return void
	 */
	public function testConstructor(): void {
		$extensionClass = $this->getExtensionClass();

		$config = $this->createConfigurationMock();
		$extension = new $extensionClass($config);

		$this->assertInstanceOf(ExtensionInterface::class, $extension);
		$this->assertInstanceOf($extensionClass, $extension);
	}
}
