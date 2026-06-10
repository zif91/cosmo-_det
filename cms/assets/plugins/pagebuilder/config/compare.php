<?php

return [
    'title'     => 'Сравнение «мойка vs студия»',
    'container' => 'default',
    'order'     => 12,
    'fields'    => [
        'eyebrow'    => ['caption' => 'Надзаголовок', 'type' => 'text', 'layout' => 'col-6'],
        'heading'    => ['caption' => 'Заголовок', 'type' => 'text', 'layout' => 'col-6'],
        'text'       => ['caption' => 'Подзаголовок', 'type' => 'textarea'],
        'bad_label'  => ['caption' => 'Левая колонка — ярлык', 'type' => 'text', 'layout' => 'col-6'],
        'bad_title'  => ['caption' => 'Левая колонка — заголовок', 'type' => 'text', 'layout' => 'col-6'],
        'bad_items'  => ['caption' => 'Левая колонка — пункты', 'type' => 'group', 'fields' => [
            'text' => ['caption' => 'Пункт', 'type' => 'text'],
        ]],
        'good_label' => ['caption' => 'Правая колонка — ярлык', 'type' => 'text', 'layout' => 'col-6'],
        'good_title' => ['caption' => 'Правая колонка — заголовок', 'type' => 'text', 'layout' => 'col-6'],
        'good_items' => ['caption' => 'Правая колонка — пункты', 'type' => 'group', 'fields' => [
            'text' => ['caption' => 'Пункт', 'type' => 'text'],
        ]],
    ],
];
