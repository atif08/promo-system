<?php

use App\Enums\UserTypeEnum;

return [
    UserTypeEnum::ADMIN()->value => [
        'management' => [
            'url'   => '',
            'icon'  => 'fas fa-money-bill',
            'title' => 'Management',

            'children' => [
                'user' => [
                    'icon'  => 'fas fa-charging-station',
                    'title' => 'Users',
                    'url'   => 'users'
                ],
                'promos' => [
                    'icon'  => 'fas fa-charging-station',
                    'title' => 'Promo Codes',
                    'url'   => 'promo-codes'
                ],
                'user_promos' => [
                    'icon'  => 'fas fa-charging-station',
                    'title' => 'User Promo Codes',
                    'url'   => 'user-promo-codes'
                ],

            ],
        ],
        'settings' => [
            'url'   => '',
            'icon'  => '',
            'title' => 'Settings',

            'children' => [
                'profile' => [
                    'icon'   => 'fas fa-user',
                    'title'  => 'Profile Settings',
                    'url'    => 'profile'
                ]
            ]
        ]
    ],

    UserTypeEnum::BUYER()->value => [
        'menu' => [
            'url'   => '',
            'icon'  => 'fa fa-home',
            'title' => 'Menu',

            'children' => [
                'dashboard' => [
                    'icon'  => 'fa fa-home',
                    'title' => 'Dashboard',
                    'url'   => 'dashboard'
                ],

                'monthly-dashboard' => [
                    'icon'  => 'fa fa-calendar-alt',
                    'title' => 'Monthly Dashboard',
                    'url'   => 'monthly-dashboard'
                ],

                'asin-dashboard' => [
                    'icon'  => 'fa fa-table',
                    'title' => 'ASIN Dashboard',
                    'url'   => 'asin-dashboard'
                ],

                'accounts-dashboard' => [
                    'icon'  => 'fa fa-store',
                    'title' => 'Accounts Dashboard',
                    'url'   => 'accounts-dashboard'
                ],

                'formulas' => [
                    'icon'  => 'fa fa-calculator',
                    'title' => 'Bids',
                    'url'   => 'rules/formulas'
                ],
            ]
        ],

        'reports' => [
            'url'      => '',
            'icon'     => '',
            'title'    => 'Reports',
            'children' => [
                'exports' => [
                    'url'    => 'exports',
                    'icon'   => 'fa fa-download',
                    'title'  => 'Export Requests',
                    'parent' => 'false',
                ],
            ]
        ],

        'settings' => [
            'url'   => '',
            'icon'  => '',
            'title' => 'Settings',

            'children' => [
                'connections' => [
                    'icon'  => 'fas fa-link',
                    'title' => 'Connections',
                    'url'   => 'connections'
                ],

                'team' => [
                    'icon'  => 'fas fa-user-cog',
                    'title' => 'Team',
                    'url'   => 'team'
                ],

                'clients' => [
                    'icon'  => 'fas fa-user-friends',
                    'title' => 'Clients',
                    'url'   => 'clients'
                ],

                'profile' => [
                    'icon'  => 'fas fa-user',
                    'title' => 'Profile Settings',
                    'url'   => 'profile'
                ]
            ]
        ]
    ],
];
