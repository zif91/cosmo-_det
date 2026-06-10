<?php

return [
    'title'     => 'Этапы работы',
    'container' => 'default',
    'order'     => 17,
    'fields'    => [
        'eyebrow' => ['caption' => 'Надзаголовок', 'type' => 'text', 'layout' => 'col-4', 'default' => 'Как мы работаем'],
        'heading' => ['caption' => 'Заголовок', 'type' => 'text', 'layout' => 'col-8'],
        'steps'   => ['caption' => 'Шаги', 'type' => 'group', 'fields' => [
            'title' => ['caption' => 'Заголовок', 'type' => 'text'],
            'text'  => ['caption' => 'Текст', 'type' => 'textarea'],
        ]],
    ],
];
