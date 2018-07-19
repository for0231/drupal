<?php

namespace Drupal\Core\Update;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Core\DependencyInjection\ServiceModifierInterface;
use Drupal\Core\DependencyInjection\ServiceProviderInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Ensures for some services that they don't cache.
 */
class UpdateServiceProvider implements ServiceProviderInterface, ServiceModifierInterface {

  /**
   * {@inheritdoc}
   */
  public function register(ContainerBuilder $container) {
    $definition = new Definition('Drupal\Core\Cache\NullBackend', ['null']);
    $container->setDefinition('cache.null', $definition);
  }

  /**
   * {@inheritdoc}
   */
  public function alter(ContainerBuilder $container) {
    $definition = $container->getDefinition('asset.resolver');
    $argument = new Reference('cache.null');
    $definition->replaceArgument(5, $argument);

    $definition = $container->getDefinition('library.discovery.collector');
    $argument = new Reference('cache.null');
    $definition->replaceArgument(0, $argument);

    // Loop over the defined services and remove any with unmet dependencies.
    // The kernel cannot be booted if the container such services. This allows
    // modules to run their update hooks to enable newly added dependencies.
    do {
      $definitions = $container->getDefinitions();
      foreach ($definitions as $key => $definition) {
        foreach ($definition->getArguments() as $argument) {
          if ($argument instanceof Reference) {
            if (!$container->has((string) $argument) && $argument->getInvalidBehavior() === ContainerInterface::EXCEPTION_ON_INVALID_REFERENCE) {
              // If the container does not have the argument and would throw an
              // exception, remove the service.
              $container->removeDefinition($key);
            }
          }
        }
      }
      // Remove any aliases which point to undefined services.
      $aliases = $container->getAliases();
      foreach ($aliases as $key => $alias) {
        if (!$container->has((string) $alias)) {
          $container->removeAlias($key);
        }
      }
      // Repeat if services or aliases have been removed.
    } while (count($definitions) > count($container->getDefinitions()) || count($aliases) > count($container->getAliases()));
  }

}
