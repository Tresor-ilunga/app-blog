<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class BasicTest
 *
 *
 * @author Trésor-ILUNGA <hello@tresor-ilunga.tech>
 */
class BasicTest extends WebTestCase
{
    public function testEnvironnementIsOk(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
    }
}