<?php

use Module\HttpRenderer\RenderStrategy\RenderDefaultStrategy;
use Module\HttpRenderer\RenderStrategy\RenderJsonStrategy;
use Module\HttpRenderer\RenderStrategy\RenderRouterStrategy;
use Module\HttpRenderer\Services\ServiceRenderStrategiesContainer;

return [
    \Module\Foundation\Services\PathService::CONF => [
        'paths' => [
            // According to route name 'www-assets' to serve statics files
            // @see cor-http_foundation.routes
            'www-theme' => "\$baseUrl/p/theme/",
        ],
    ],

    \Module\HttpRenderer\Module::CONF => [
        ServiceRenderStrategiesContainer::CONF => [
            'services' => [
                'router'  => RenderRouterStrategy::class,
                'default' => RenderDefaultStrategy::class,
                'json'    => RenderJsonStrategy::class,
            ],
        ],
    ],

    // View Renderer Options
    RenderDefaultStrategy::CONF_KEY => [
        'themes' => [
            'default' => [
                'dir' => __DIR__.'/../theme',
                // (bool) func()
                // function will instantiated for resolve arguments
                // or true|false
                'when' => true, // always use this template
                'priority' => -1000,
                'layout' => [
                    'default' => 'default',
                    'exception' => [
                        ## full name of class exception

                        ## use null on second index cause view template render as final layout
                        // 'Exception' => ['error/error', null],
                        // 'Specific\Error\Exception' => ['error/spec', 'override_layout_name_here']

                        ## here (blank) is defined as default layout for all error pages
                        'Exception' => ['error/error', 'blank'],
                        'Poirot\Application\Exception\exRouteNotMatch' => 'error/404',
                    ],
                ],
            ],
        ],
    ],
];
