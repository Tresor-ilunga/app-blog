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
 *
 * @author Trésor-ILUNGA <hello@tresor-ilunga.tech>
 */
class DropdownCategoriesSubscriber implements EventSubscriberInterface
{
    const ROUTES = ['post.index', 'category.index'];

    /**
     * DropdownCategoriesSubscriber constructor.
     *
     * @param CategoryRepository $categoryRepository
     * @param Environment $twig
     */
    public function __construct(
        private CategoryRepository $categoryRepository,
        private Environment $twig
    ) {
    }

    /**
     * Inject global variable to all routes
     *
     * @param RequestEvent $event
     * @return void
     */
    public function injectGlobalVariable(RequestEvent $event): void
    {
        $route = $event->getRequest()->get('_route');
        if (in_array($route, DropdownCategoriesSubscriber::ROUTES)) {
            $categories = $this->categoryRepository->findAll();
            $this->twig->addGlobal('allCategories', $categories);
        }
    }

    /**
     * This method must return an array with the event names as keys and the method names to call as values:
     *
     * @return string[]
     */
    public static function getSubscribedEvents(): array
    {
        return [KernelEvents::REQUEST => 'injectGlobalVariable'];
    }
}
