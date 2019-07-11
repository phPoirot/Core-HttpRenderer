<?php
use Module\HttpFoundation\Events\Listener\ListenerDispatch;


return [
    'www-theme' => [
        'route' => 'RouteMethodSegment',
        'options' => [
            'method'   => 'GET',
            'criteria' => '/assets/www</:file~.+~>',
            'match_whole' => false,
        ],
        'params' => [
            ListenerDispatch::ACTIONS => \Poirot\Ioc\newInitIns( new \Poirot\Ioc\instance(
                \Module\HttpFoundation\Actions\FileServeAction::class
                , [ 'baseDir' => __DIR__.'/../view/www' ]
            ) ),
        ],
    ],
];
