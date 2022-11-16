<?php
/*
 * This file is part of the GoogleTagManagerBundle project
 *
 * (c) Philipp Braeutigam <philipp.braeutigam@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xynnn\GoogleTagManagerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 *
 * @package Xynnn\GoogleTagManagerBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('google_tag_manager');

        $rootNode = $treeBuilder->getRootNode();
        $rootNode
            ->children()
                ->booleanNode('enabled')->end()
                ->scalarNode('id')->end()
                ->booleanNode('autoAppend')->defaultFalse()->end()
                ->scalarNode('additionalParameters')->defaultNull()->end()
            ->end();

        return $treeBuilder;
    }
}
