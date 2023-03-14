<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use App\Repository\Post\CategoryRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;

/**
 * Class DropdownCategoriesSubscriber
 * @author Tresor-ilunga <ilungat82@gmail.com>
 */
class DropdownCategoriesSubscriber implements EventSubscriberInterface
{
    const ROUTES = ['post.index', 'category.index'];

    public function __construct(
        private CategoryRepository $categoryRepository,
        private Environment $twig
    ) {
    }

    public function injectGlobalVariable(RequestEvent $event): void
    {
        $route = $event->getRequest()->get('_route');
        if (in_array($route, DropdownCategoriesSubscriber::ROUTES)) {
            $categories = $this->categoryRepository->findAll();
            $this->twig->addGlobal('allCategories', $categories);
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [KernelEvents::REQUEST => 'injectGlobalVariable'];
    }
}
