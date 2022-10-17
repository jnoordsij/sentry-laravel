<?php

namespace Sentry\Laravel\Tests;

use Sentry\ClientBuilderInterface;

class ClientBuilderDecoratorTest extends TestCase
{
    protected function getEnvironmentSetUp($app): void
    {
        parent::getEnvironmentSetUp($app);

        $app->extend(ClientBuilderInterface::class, function (ClientBuilderInterface $clientBuilder) {
            $clientBuilder->getOptions()->setEnvironment('from_service_container');

            return $clientBuilder;
        });
    }

    public function testClientHasEnvironmentSetFromDecorator(): void
    {
        $this->assertEquals(
            'from_service_container',
            $this->getClientFromContainer()->getOptions()->getEnvironment()
        );
    }
}
