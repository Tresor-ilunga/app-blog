<?php

declare(strict_types=1);

namespace App\Tests\Functional\Category;

use App\Entity\Post\Category;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CategoryTest
 * @author Tresor-ilunga <19im065@esisalama.org>
 */
class CategoryTest extends WebTestCase
{
    public function testCategoryPageWorks(): void
    {
        $client = static::createClient();

        /** @var  $urlGeneratorInterface */
        $urlGeneratorInterface = $client->getContainer()->get('router');

        /** @var  $entityManager */
        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        /** @var  $categoryRepository */
        $categoryRepository = $entityManager->getRepository(Category::class);

        /** @var  $category */
        $category = $categoryRepository->findOneBy([]);

        $client->request(Request::METHOD_GET,
            $urlGeneratorInterface->generate('category.index', ['slug' => $category->getSlug()]));

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $this->assertSelectorExists('h1');
        $this->assertSelectorTextContains('h1', 'Catégorie : ' . ucfirst($category->getName()));
    }

    public function testPaginationWorks(): void
    {
        $client = static::createClient();

        /** @var  $urlGeneratorInterface */
        $urlGeneratorInterface = $client->getContainer()->get('router');

        /** @var  $entityManager */
        $entityManager = $client->getContainer()->get('doctrine.orm.entity_manager');

        /** @var  $categoryRepository */
        $categoryRepository = $entityManager->getRepository(Category::class);

        /** @var  $category */
        $category = $categoryRepository->findOneBy([]);

        $crawler = $client->request(Request::METHOD_GET,
            $urlGeneratorInterface->generate('category.index', ['slug' => $category->getSlug()]));


        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $posts = $crawler->filter('div.card');
        $this->assertEquals(9, count($posts));

        $link = $crawler->selectLink('2')->extract(['href'])[0];
        $crawler = $client->request(Request::METHOD_GET, $link);

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $posts = $crawler->filter('div.card');
        $this->assertGreaterThanOrEqual(1, count($posts));
    }
}