<?php

return [
    'title'     => 'Прайс-таблица',
    'container' => 'default',
    'order'     => 3,
    'fields'    => [
        'eyebrow' => ['caption' => 'Надзаголовок', 'type' => 'text', 'layout' => 'col-4', 'default' => 'Услуги и цены'],
        'heading' => ['caption' => 'Заголовок', 'type' => 'text', 'layout' => 'col-8'],
        'text'    => ['caption' => 'Подзаголовок', 'type' => 'textarea'],
        'rows'    => ['caption' => 'Позиции прайса', 'type' => 'group', 'fields' => [
            'name'  => ['caption' => 'Услуга', 'type' => 'text', 'layout' => 'col-5'],
            'descr' => ['caption' => 'Описание', 'type' => 'text', 'layout' => 'col-5'],
            'price' => ['caption' => 'Цена', 'type' => 'text', 'layout' => 'col-2'],
        ]],
        'note'    => ['caption' => 'Примечание под таблицей', 'type' => 'text'],
    ],
];
