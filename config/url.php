<?php

return [
    'enablePrettyUrl' => true,
    'showScriptName'  => false,
    //'suffix'          => '.html',
    'rules'           => [
        '<controller:(product|news)>-<id:\d+>.html' => '<controller>/detail',
        '<controller:(product|news|index)>.html'    => '<controller>/index',
        'about.html'                                => 'public/about',
        'guestbook.html'                            => 'public/guestbook',
        'contact.html'                              => 'public/contact',
        '404.html'                                  => 'public/error',
        'admin'                                     => 'admin/default/index',
    ],
];
