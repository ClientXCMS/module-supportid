<?php

use App\SupportID\SupportIDDashboardItem;
use function DI\add;
use function DI\get;

return [
    'auth.entity' => \App\SupportID\SupportIDUser::class,
    'admin.dashboard.items' => add(get(SupportIDDashboardItem::class)),
];