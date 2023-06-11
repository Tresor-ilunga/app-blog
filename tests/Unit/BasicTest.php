<?php

declare(strict_types=1);

namespace App\Tests\Unit;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Class BasicTest
 *
 *
 * @author Tresor-ilunga <19im065@esisalama.org>
 */
class BasicTest extends KernelTestCase
{
    public function testEnvironnementIsOk(): void
    {
        $this->assertTrue(true);
    }
}