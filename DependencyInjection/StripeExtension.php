<?php

/*
 * This file is part of the SerendipityHQ Stripe Bundle.
 *
 * Copyright (c) Adamo Crespi <hello@aerendir.me>.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SerendipityHQ\Bundle\StripeBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * {@inheritdoc}
 *
 * @author Adamo Aerendir Crespi <hello@aerendir.me>
 */
class StripeExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        // Set parameters in the container
        $container->setParameter('stripe_bundle.db_driver', $config['db_driver']);
        $container->setParameter(sprintf('stripe_bundle.backend_%s', $config['db_driver']), true);
        $container->setParameter('stripe_bundle.model_manager_name', $config['model_manager_name']);
        $container->setParameter('stripe_bundle.secret_key', $config['stripe_config']['secret_key']);
        $container->setParameter('stripe_bundle.publishable_key', $config['stripe_config']['publishable_key']);
        $container->setParameter('stripe_bundle.kernel_environment', $config['kernel_environment']);
        $container->setParameter('stripe_bundle.endpoint', $config['endpoint']);

        $filelocator = new FileLocator(__DIR__ . '/../Resources/config');
        $xmlLoader = new Loader\XmlFileLoader($container, $filelocator);
        $xmlLoader->load('listeners.xml');
        $xmlLoader->load('services.xml');

        // load db_driver container configuration
        $xmlLoader->load(sprintf('%s.xml', $config['db_driver']));
    }
}
