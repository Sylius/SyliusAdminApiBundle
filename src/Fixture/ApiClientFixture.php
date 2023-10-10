<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Sylius\Bundle\AdminApiBundle\Fixture;

use Sylius\Bundle\CoreBundle\Fixture\AbstractResourceFixture;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

class ApiClientFixture extends AbstractResourceFixture
{
    public function getName(): string
    {
        return 'api_client';
    }

    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        /** @psalm-suppress UndefinedInterfaceMethod,PossiblyUndefinedMethod */
        $resourceNode
            ->children()
                ->scalarNode('random_id')->cannotBeEmpty()->end()
                ->scalarNode('secret')->cannotBeEmpty()->end()
                ->arrayNode('allowed_grant_types')->scalarPrototype()->cannotBeEmpty()->defaultValue([])->end()
        ;
    }
}
