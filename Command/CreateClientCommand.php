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

namespace Sylius\Bundle\AdminApiBundle\Command;

use FOS\OAuthServerBundle\Model\ClientManagerInterface;
use Sylius\Bundle\AdminApiBundle\Model\Client;
use SyliusLabs\Polyfill\Symfony\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Webmozart\Assert\Assert;

/**
 * @deprecated Fetching dependencies directly from container is not recommended from Symfony 3.4. Extending `ContainerAwareCommand` will be removed in 2.0
 */
final class CreateClientCommand extends ContainerAwareCommand
{
    /** @var ClientManagerInterface|null */
    private $clientManager;

    protected static $defaultName = 'sylius:oauth-server:create-client';

    public function __construct(?string $name = null, ClientManagerInterface $clientManager = null)
    {
        parent::__construct($name);

        $this->clientManager = $clientManager;
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Creates a new client')
            ->addOption(
                'redirect-uri',
                null,
                InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
                'Sets redirect uri for client.'
            )
            ->addOption(
                'grant-type',
                null,
                InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY,
                'Sets allowed grant type for client.'
            )
            ->setHelp(<<<EOT
The <info>%command.name%</info>command creates a new client.
<info>php %command.full_name% [--redirect-uri=...] [--grant-type=...] name</info>
EOT
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if (null === $this->clientManager) {
            @trigger_error('Fetching services directly from the container is deprecated since Sylius 1.2 and will be removed in 2.0.', \E_USER_DEPRECATED);

            $clientManager = $this->getContainer()->get('fos_oauth_server.client_manager.default');

            Assert::isInstanceOf($clientManager, ClientManagerInterface::class);

            $this->clientManager = $clientManager;
        }

        /** @var Client $client */
        $client = $this->clientManager->createClient();
        $client->setRedirectUris($input->getOption('redirect-uri'));
        $client->setAllowedGrantTypes($input->getOption('grant-type'));
        $this->clientManager->updateClient($client);

        $output->writeln(
            sprintf(
                'A new client with public id <info>%s</info>, secret <info>%s</info> has been added',
                $client->getPublicId(),
                $client->getSecret()
            )
        );

        return 0;
    }
}
