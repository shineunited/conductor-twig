# shineunited/conductor-twig-addon

[![License](https://img.shields.io/packagist/l/shineunited/conductor-twig-addon)](https://github.com/shineunited/conductor-twig-addon/blob/main/LICENSE)
[![Latest Version](https://img.shields.io/packagist/v/shineunited/conductor-twig-addon?label=latest)](https://packagist.org/packages/shineunited/conductor-twig-addon/)
[![PHP Version](https://img.shields.io/packagist/dependency-v/shineunited/conductor-twig-addon/php?label=php)](https://www.php.net/releases/index.php)
[![Main Status](https://img.shields.io/github/workflow/status/shineunited/conductor-twig-addon/Build/main?label=main)](https://github.com/shineunited/conductor-twig-addon/actions/workflows/build.yml?query=branch%3Amain)
[![Release Status](https://img.shields.io/github/workflow/status/shineunited/conductor-twig-addon/Build/release?label=release)](https://github.com/shineunited/conductor-twig-addon/actions/workflows/build.yml?query=branch%3Arelease)
[![Develop Status](https://img.shields.io/github/workflow/status/shineunited/conductor-twig-addon/Build/develop?label=develop)](https://github.com/shineunited/conductor-twig-addon/actions/workflows/build.yml?query=branch%3Adevelop)

## Description

Add support for Twig templates to the Conductor generator/blueprint framework.


## Installation

To add conductor-twig-addon, the recommended method is via composer.
```sh
$ composer require shineunited/conductor-twig-addon
```


## Usage

### NamespaceProvider Capability
The NamespaceProvider capability registers Twig template include paths.

#### Example Plugin
The plugin must implement Capable and provide the NamespaceProvider capability.
```php
<?php

namespace Example\Project;

use Composer\Composer;
use Composer\IO\IOInterface;
use ShineUnited\Conductor\Addon\Twig\Capability\NamespaceProvider;
use ShineUnited\Conductor\Capability\BlueprintProvider;

class ComposerPlugin implements PluginInterface, Capable {

	public function activate(Composer $composer, IOInterface $io): void {
		// ...
	}

	public function deactivate(Composer $composer, IOInterface $io): void {
		// ...
	}

	public function uninstall(Composer $composer, IOInterface $io): void {
		// ...
	}

	public function getCapabilities(): array {
		return [
			NamespaceProvider::class => ExampleNamespaceProvider::class,
			BlueprintProvider::class => ExampleBlueprintProvider::class
		];
	}
}
```

#### Example Provider
The provider must implement the capability, and return a list of TwigNamespaceInterface objects.
```php
<?php

namespace Example\Project;

use ShineUnited\Conductor\Addon\Twig\Capability\NamespaceProvider;
use ShineUnited\Conductor\Addon\Twig\Loader\TwigNamespace;

class ExampleNamespaceProvider implements NamespaceProvider {

	public function getNamespaces(): array {
		return [
			new TwigNamespace('path/to/template/dir', 'optional-namespace'),
			new TwigNamespace('path/to/global/templates') // load in root namespace
		];
	}
}
```

These namespaces can then be used in a blueprint provider with the TwigBlueprint.

```php
<?php

namespace Example\Project;

use ShineUnited\Conductor\Capability\BlueprintProvider;
use ShineUnited\Conductor\Addon\Twig\Blueprint\TwigBlueprint;

class ExampleBlueprintProvider implements BlueprintProvider {

	public function getBlueprints(): array {
		return [
			new TwigBlueprint('path/to/file.html', '@namespace/template.twig'),
			new TwigBlueprint('another/file.html', 'global.twig')
		];
	}
}
