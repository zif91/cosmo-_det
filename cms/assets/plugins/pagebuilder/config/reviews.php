<?php

return [
    'title'     => 'Отзывы',
    'container' => 'default',
    'order'     => 20,
    'fields'    => [
        'eyebrow' => ['caption' => 'Надзаголовок', 'type' => 'text', 'layout' => 'col-4', 'default' => 'Отзывы клиентов'],
        'heading' => ['caption' => 'Заголовок', 'type' => 'text', 'layout' => 'col-8'],
        'text'    => ['caption' => 'Подзаголовок', 'type' => 'textarea'],
        'items'   => ['caption' => 'Отзывы', 'type' => 'group', 'fields' => [
            'stars' => ['caption' => 'Звёзды (1–5)', 'type' => 'dropdown', 'layout' => 'col-3', 'elements' => ['5' => '5', '4' => '4', '3' => '3', '2' => '2', '1' => '1'], 'default' => '5'],
            'name'  => ['caption' => 'Имя', 'type' => 'text', 'layout' => 'col-4'],
            'car'   => ['caption' => 'Авто · услуга', 'type' => 'text', 'layout' => 'col-5'],
            'text'  => ['caption' => 'Текст отзыва', 'type' => 'textarea'],
        ]],
    ],
];
