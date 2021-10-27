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

namespace Tests\Sylius\Bundle\AdminApiBundle\Controller;

use ApiTestCase\JsonApiTestCase;
use Sylius\Component\Payment\Model\PaymentMethodInterface;
use Symfony\Component\HttpFoundation\Response;

final class PaymentMethodApiTest extends JsonApiTestCase
{
    private static array $authorizedHeaderWithContentType = [
        'HTTP_Authorization' => 'Bearer SampleTokenNjZkNjY2MDEwMTAzMDkxMGE0OTlhYzU3NzYyMTE0ZGQ3ODcyMDAwM2EwMDZjNDI5NDlhMDdlMQ',
        'CONTENT_TYPE' => 'application/json',
    ];

    /**
     * @test
     */
    public function it_denies_getting_payment_method_for_non_authenticated_user(): void
    {
        $this->client->request('GET', '/api/v1/payment-methods/none');

        $response = $this->client->getResponse();
        $this->assertResponse($response, 'authentication/access_denied_response', Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @test
     */
    public function it_does_not_allow_to_show_payment_methods_list_when_access_is_denied(): void
    {
        $this->loadFixturesFromFiles([
            'resources/channels.yml',
            'resources/gateway_config.yml',
            'resources/payment_methods.yml',
        ]);

        $this->client->request('GET', '/api/v1/payment-methods/');

        $response = $this->client->getResponse();
        $this->assertResponse($response, 'authentication/access_denied_response', Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @test
     */
    public function it_does_not_allow_to_show_payment_method_when_it_does_not_exist(): void
    {
        $this->loadFixturesFromFile('authentication/api_administrator.yml');

        $this->client->request('GET', '/api/v1/payment-methods/none', [], [], static::$authorizedHeaderWithContentType);

        $response = $this->client->getResponse();
        $this->assertResponse($response, 'error/not_found_response', Response::HTTP_NOT_FOUND);
    }

    /**
     * @test
     */
    public function it_allows_showing_payment_method(): void
    {
        $paymentMethods = $this->loadFixturesFromFiles([
            'authentication/api_administrator.yml',
            'resources/channels.yml',
            'resources/gateway_config.yml',
            'resources/payment_methods.yml',
        ]);

        /** @var PaymentMethodInterface $paymentMethod */
        $paymentMethod = $paymentMethods['cash_on_delivery'];

        $this->client->request('GET', $this->getPaymentMethodUrl($paymentMethod), [], [], static::$authorizedHeaderWithContentType);

        $response = $this->client->getResponse();
        $this->assertResponse($response, 'payment_method/show_response', Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function it_allows_indexing_payment_methods(): void
    {
        $this->loadFixturesFromFiles([
            'authentication/api_administrator.yml',
            'resources/channels.yml',
            'resources/gateway_config.yml',
            'resources/payment_methods.yml',
        ]);

        $this->client->request(
            'GET',
            '/api/v1/payment-methods/',
            [],
            [],
            self::$authorizedHeaderWithContentType
        );

        $response = $this->client->getResponse();
        $this->assertResponse($response, 'payment_method/index_response', Response::HTTP_OK);
    }

    /**
     * @test
     */
    public function it_allows_creating_payment_method(): void
    {
        $this->loadFixturesFromFiles([
            'authentication/api_administrator.yml',
            'resources/channels.yml',
            'resources/gateway_config.yml',
        ]);

        $data = <<<JSON
{
    "code": "test_payment_method",
    "enabled": true,
    "translations": {
        "en_US": {
            "name": "Test Payment Method",
            "description": "Description of Test Payment Method",
            "instructions": "Instructions of Test Payment Method"
        }
    },
    "channels": ["WEB"],
    "position": 1
}
JSON;

        $this->client->request(
            'POST',
            '/api/v1/payment-methods/offline',
            [],
            [],
            self::$authorizedHeaderWithContentType,
            $data
        );

        $this->assertResponse(
            $this->client->getResponse(),
            'payment_method/create_response',
            Response::HTTP_CREATED
        );
    }

    /**
     * @test
     */
    public function it_does_not_allow_creating_payment_methods_when_not_authorized(): void
    {
        $this->loadFixturesFromFiles([
            'resources/channels.yml',
            'resources/gateway_config.yml',
        ]);

        $data = <<<JSON
{
    "code": "test_payment_method",
    "enabled": true,
    "translations": {
        "en_US": {
            "name": "Test Payment Method",
            "description": "Description of Test Payment Method",
            "instructions": "Instructions of Test Payment Method"
        }
    },
    "channels": ["WEB"],
    "position": 1
}
JSON;

        $this->client->request(
            'POST',
            '/api/v1/payment-methods/offline',
            [],
            [],
            [],
            $data
        );

        $this->assertResponse(
            $this->client->getResponse(),
            'authentication/access_denied_response',
            Response::HTTP_UNAUTHORIZED
        );
    }

    private function getPaymentMethodUrl(PaymentMethodInterface $paymentMethod): string
    {
        return '/api/v1/payment-methods/' . $paymentMethod->getCode();
    }
}
