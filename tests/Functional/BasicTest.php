<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class BasicTest
 *
 *
 * @author Tresor-ilunga <19im065@esisalama.org>
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