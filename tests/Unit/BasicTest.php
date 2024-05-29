<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class BasicTest
 *
 *
 * @author Trésor-ILUNGA <hello@tresor-ilunga.tech>
 */
class BasicTest extends KernelTestCase
{
    public function testEnvironnementIsOk(): void
    {
        $this->assertTrue(true);
    }
}