<?php

namespace App\SupportID;

use App\SupportID\Actions\SupportIDSearchAction;
use ClientX\Event\EventManager;
use ClientX\Renderer\RendererInterface;
use ClientX\Router;
use ClientX\Theme\ThemeInterface;

class SupportIDModule extends \ClientX\Module
{

    const DEFINITIONS = __DIR__ . '/config.php';

    public function __construct(ThemeInterface $theme, RendererInterface $renderer, EventManager $eventManager, SupportIDNewLogin $event, Router $router)
    {

        $renderer->addPath("supportid_admin", __DIR__ . '/Views');
        $renderer->addPath("supportid", $theme->getViewsPath(). '/SupportID');
        $eventManager->attach('auth.login', $event);
        $eventManager->attach('account.signup', $event);
        $router->post('/admin/supportid', SupportIDSearchAction::class, 'supportid.search');
    }

}