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

namespace ShineUnited\Conductor\Addon\Twig\Generator;

use ShineUnited\Conductor\Addon\Twig\Blueprint\TwigBlueprint;
use ShineUnited\Conductor\Filesystem\File;
use ShineUnited\Conductor\Filesystem\Blueprint\BlueprintInterface;
use ShineUnited\Conductor\Filesystem\Generator\GeneratorInterface;
use ShineUnited\Conductor\Configuration\Configuration;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginManager;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use ShineUnited\Conductor\Addon\Twig\Extension\ConfigExtension;
use ShineUnited\Conductor\Addon\Twig\Extension\PathExtension;
use ShineUnited\Conductor\Addon\Twig\Capability\NamespaceProvider as NamespaceProviderCapability;
use ShineUnited\Conductor\Addon\Twig\Loader\TwigNamespace;

/**
 * Twig Generator
 */
class TwigGenerator implements GeneratorInterface {
	public const TYPE = 'twig';

	/**
	 * {@inheritDoc}
	 */
	public function handlesType(string $type): bool {
		$type = strtolower(trim($type));

		if ($type == self::TYPE) {
			return true;
		}

		return false;
	}

	/**
	 * {@inheritDoc}
	 *
	 * @throws \Exception If not instance of TwigBlueprint
	 */
	public function generateContents(BlueprintInterface $blueprint, File $file, Configuration $config): string {
		if (!$blueprint instanceof TwigBlueprint) {
			throw new \Exception('Invalid ' . TwigBlueprint::class);
		}

		$environment = $config->processCallableValue(function (Configuration $config, PluginManager $pluginManager) {
			$loader = new FilesystemLoader();

			$providers = $pluginManager->getPluginCapabilities(NamespaceProviderCapability::class, [
				'config' => $config
			]);
			foreach ($providers as $provider) {
				foreach ($provider->getNamespaces() as $namespace) {
					if (!$namespace instanceof TwigNamespace) {
						throw new \Exception('Invalid twig namespace: ' . get_class($namespace));
					}

					$paths = $config->processValue($namespace->getPaths());
					$name = $namespace->getName();
					if (is_null($name)) {
						$name = FilesystemLoader::MAIN_NAMESPACE;
					} else {
						$name = $config->processValue($name);
					}

					$loader->setPaths($paths, $name);
				}
			}

			$environment = new Environment($loader);

			$environment->addExtension(new ConfigExtension($config));
			$environment->addExtension(new PathExtension($config));

			return $environment;
		});

		$template = $config->processValue($blueprint->getTemplate());
		$context = $config->processValue($blueprint->getContext());

		return $environment->render($template, $context);
	}
}
