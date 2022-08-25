<?php

return [
    'name' => 'Backup',
    'menus' => [
        [
            'text' => 'Settings',
            'icon' => 'fas fa-cogs',
            'can' => 'settings-read',
            'order' => 100,
            'submenu' => [
                [
                    'text' => 'Backup',
                    'route' => 'admin.backup.index',
                    'can' => 'backup-read',
                    'order' => 130,
                ],
                [
                    'text' => 'Restore',
                    'route' => 'admin.restore.index',
                    'can' => 'restore-read',
                    'order' => 131,
                ],
                [
                    'text' => 'Reset System',
                    'route' => 'admin.reset.index',
                    'can' => 'reset-read',
                    'order' => 132,
                ],
            ],
        ],
    ],
];
