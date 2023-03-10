<?php

declare(strict_types=1);

namespace App\Model;

/**
 * Class SearchData
 * @author Tresor-ilunga <19im065@esisalama.org>
 */
class SearchData
{
    /** @var int */
    public int $page = 1;

    /** @var string */
    public string $q = '';

    /** @var array */
    public array $categories = [];

}