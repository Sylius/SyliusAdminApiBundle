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

class ApiAccessTokenFixture extends AbstractResourceFixture
{
    public function getName(): string
    {
        return 'access_token';
    }

    protected function configureResourceNode(ArrayNodeDefinition $resourceNode): void
    {
        /** @psalm-suppress UndefinedInterfaceMethod,PossiblyUndefinedMethod */
        $resourceNode
            ->children()
                ->scalarNode('client')->cannotBeEmpty()->end()
                ->scalarNode('token')->cannotBeEmpty()->end()
                ->scalarNode('user')->cannotBeEmpty()->end()
                ->scalarNode('expires_at')->end()
        ;
    }
}
