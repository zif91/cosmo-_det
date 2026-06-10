<?php

return [
    'title'     => 'Галерея работ',
    'container' => 'default',
    'order'     => 4,
    'fields'    => [
        'anchor'    => ['caption' => 'Якорь (id секции)', 'type' => 'text', 'layout' => 'col-4'],
        'eyebrow'   => ['caption' => 'Надзаголовок', 'type' => 'text', 'layout' => 'col-4', 'default' => 'Наши работы'],
        'heading'   => ['caption' => 'Заголовок', 'type' => 'text', 'layout' => 'col-4'],
        'text'      => ['caption' => 'Подзаголовок', 'type' => 'textarea'],
        'shots'     => ['caption' => 'Снимки', 'type' => 'group', 'fields' => [
            'image'   => ['caption' => 'Фото (полное)', 'type' => 'image', 'layout' => 'col-4'],
            'thumb'   => ['caption' => 'Превью (опц.)', 'type' => 'image', 'layout' => 'col-4'],
            'tag'     => ['caption' => 'Метка', 'type' => 'text', 'layout' => 'col-2'],
            'caption' => ['caption' => 'Подпись', 'type' => 'text', 'layout' => 'col-2'],
        ]],
        'more_text' => ['caption' => 'Кнопка внизу — текст', 'type' => 'text', 'layout' => 'col-6'],
        'more_link' => ['caption' => 'Кнопка внизу — ссылка', 'type' => 'text', 'layout' => 'col-6'],
    ],
];
