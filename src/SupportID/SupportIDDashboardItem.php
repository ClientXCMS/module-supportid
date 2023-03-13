<?php
namespace App\SupportID;
class SupportIDDashboardItem implements \ClientX\Navigation\NavigationItemInterface
{

    public function getPosition(): int
    {
        return 30;
    }

    public function render(\ClientX\Renderer\RendererInterface $renderer): string
    {
        return $renderer->render('@supportid_admin/search');
    }
}