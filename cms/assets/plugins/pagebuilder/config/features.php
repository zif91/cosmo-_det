<?php

return [
    'title'     => 'Преимущества (4 колонки)',
    'container' => 'default',
    'order'     => 5,
    'fields'    => [
        'eyebrow' => ['caption' => 'Надзаголовок', 'type' => 'text', 'layout' => 'col-4', 'default' => 'Почему Космос'],
        'heading' => ['caption' => 'Заголовок', 'type' => 'text', 'layout' => 'col-8'],
        'items'   => ['caption' => 'Карточки', 'type' => 'group', 'fields' => [
            'icon'  => ['caption' => 'Иконка (SVG-код)', 'type' => 'textarea'],
            'title' => ['caption' => 'Заголовок', 'type' => 'text'],
            'text'  => ['caption' => 'Текст', 'type' => 'textarea'],
        ]],
    ],
];
