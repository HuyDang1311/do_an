<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | The default title of your admin panel, this goes into the title tag
    | of your page. You can override it per page with the title section.
    | You can optionally also specify a title prefix and/or postfix.
    |
    */

    'title' => 'Vé xe online',

    'title_prefix' => '',

    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | This logo is displayed at the upper left corner of your admin panel.
    | You can use basic HTML here if you want. The logo has also a mini
    | variant, used for the mini side bar. Make it 3 letters or so
    |
    */

    'logo' => '<b>Vé xe online</b>',

    'logo_mini' => '<img src="favicon.ico" style="width: 70%;"/>',

    /*
    |--------------------------------------------------------------------------
    | Skin Color
    |--------------------------------------------------------------------------
    |
    | Choose a skin color for your admin panel. The available skin colors:
    | blue, black, purple, yellow, red, and green. Each skin also has a
    | ligth variant: blue-light, purple-light, purple-light, etc.
    |
    */

    'skin' => 'blue',

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Choose a layout for your admin panel. The available layout options:
    | null, 'boxed', 'fixed', 'top-nav'. null is the default, top-nav
    | removes the sidebar and places your menu in the top navbar
    |
    */

    'layout' => null,

    /*
    |--------------------------------------------------------------------------
    | Collapse Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we choose and option to be able to start with a collapsed side
    | bar. To adjust your sidebar layout simply set this  either true
    | this is compatible with layouts except top-nav layout option
    |
    */

    'collapse_sidebar' => false,

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Register here your dashboard, logout, login and register URLs. The
    | logout URL automatically sends a POST request in Laravel 5.3 or higher.
    | You can set the request to a GET or POST with logout_method.
    | Set register_url to null if you don't want a register link.
    |
    */

    'dashboard_url' => 'home',

    'logout_url' => 'logout',

    'logout_method' => 'POST',

    'login_url' => 'login',

    'register_url' => 'register',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Specify your menu items to display in the left sidebar. Each menu item
    | should have a text and and a URL. You can also specify an icon from
    | Font Awesome. A string instead of an array represents a header in sidebar
    | layout. The 'can' is a filter on Laravel's built in Gate functionality.
    |
    */

    'menu' => [
        'MENU',
        [
            'text'        => 'Quản lý bến xe',
            'icon'        => 'bus',
            'label_color' => 'success',
            'submenu' => [
                [
                    'text' => 'Danh sách bến xe',
                    'url'  => 'bus-stations/index',
                    'icon' => 'list',
                ],
                [
                    'text' => 'Đăng ký bến xe mới',
                    'url'  => 'bus-stations/create',
                    'icon' => 'plus-square',
                ],
            ],
        ],
        [
            'text'        => 'Quản lý nhà xe',
            'icon'        => 'home',
            'label_color' => 'success',
            'submenu' => [
                [
                    'text' => 'Danh sách nhà xe',
                    'url'  => 'companies/index',
                    'icon' => 'list',
                ],
                [
                    'text' => 'Đăng ký nhà xe mới',
                    'url'  => 'companies/create',
                    'icon' => 'plus-square',
                ],
            ],
        ],
        [
            'text'        => 'Quản lý xe',
            'icon'        => 'car',
            'label_color' => 'success',
            'submenu' => [
                [
                    'text' => 'Danh sách xe',
                    'url'  => 'cars/index',
                    'icon' => 'list',
                ],
                [
                    'text' => 'Đăng ký xe mới',
                    'url'  => 'cars/create',
                    'icon' => 'plus-square',
                ],
            ],
        ],
        [
            'text'        => 'Quản lý tài xế',
            'icon'        => 'id-card',
            'label_color' => 'success',
            'submenu' => [
                [
                    'text' => 'Danh sách tài xế',
                    'url'  => 'drivers/index',
                    'icon' => 'list',
                ],
                [
                    'text' => 'Đăng ký tài xế mới',
                    'url'  => 'drivers/create',
                    'icon' => 'plus-square',
                ],
            ],
        ],
        [
            'text'        => 'Quản lý khách hàng',
            'icon'        => 'user-circle-o',
            'label_color' => 'success',
            'submenu' => [
                [
                    'text' => 'Danh sách khách hàng',
                    'url'  => 'customers/index',
                    'icon' => 'list',
                ],
                [
                    'text' => 'Đăng ký khách hàng mới',
                    'url'  => 'customers/create',
                    'icon' => 'plus-square',
                ],
            ],
        ],
        [
            'text'        => 'Quản lý lịch trình',
            'icon'        => 'calendar-check-o',
            'label_color' => 'success',
            'submenu' => [
                [
                    'text' => 'Danh sách lịch trình',
                    'url'  => 'plans/index',
                    'icon' => 'list',
                ],
                [
                    'text' => 'Đăng ký lịch trình mới',
                    'url'  => 'plans/create',
                    'icon' => 'plus-square',
                ],
            ],
        ],
        [
            'text'        => 'Danh sách đặt chỗ',
            'icon'        => 'bar-chart',
            'url'         => 'orders/index',
            'label_color' => 'success',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Choose what filters you want to include for rendering the menu.
    | You can add your own filters to this array after you've created them.
    | You can comment out the GateFilter if you don't want to use Laravel's
    | built in Gate functionality
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SubmenuFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Choose which JavaScript plugins should be included. At this moment,
    | only DataTables is supported as a plugin. Set the value to true
    | to include the JavaScript file from a CDN via a script tag.
    |
    */

    'plugins' => [
        'datatables' => true,
        'select2'    => true,
        'chartjs'    => true,
    ],
];
