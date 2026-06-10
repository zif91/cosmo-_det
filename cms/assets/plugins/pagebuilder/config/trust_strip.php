<?php

return [
    'title'     => 'Полоса доверия (4 пункта)',
    'container' => 'default',
    'order'     => 11,
    'fields'    => [
        'items' => ['caption' => 'Пункты', 'type' => 'group', 'fields' => [
            'icon'  => ['caption' => 'Иконка (SVG-код)', 'type' => 'textarea'],
            'title' => ['caption' => 'Заголовок', 'type' => 'text'],
            'text'  => ['caption' => 'Текст', 'type' => 'textarea'],
        ]],
    ],
];
