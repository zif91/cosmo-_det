<?php

return [
    'title'     => 'Сплит с брендами',
    'container' => 'default',
    'order'     => 19,
    'fields'    => [
        'eyebrow'   => ['caption' => 'Надзаголовок', 'type' => 'text', 'layout' => 'col-6'],
        'heading'   => ['caption' => 'Заголовок', 'type' => 'text', 'layout' => 'col-6'],
        'lead'      => ['caption' => 'Текст', 'type' => 'textarea'],
        'brands'    => ['caption' => 'Бренды', 'type' => 'group', 'fields' => [
            'name' => ['caption' => 'Название', 'type' => 'text'],
        ]],
        'btn_text'  => ['caption' => 'Кнопка — текст', 'type' => 'text', 'layout' => 'col-6'],
        'btn_link'  => ['caption' => 'Кнопка — ссылка', 'type' => 'text', 'layout' => 'col-6'],
        'image'     => ['caption' => 'Фото', 'type' => 'image', 'layout' => 'col-4'],
        'image_alt' => ['caption' => 'Alt фото', 'type' => 'text', 'layout' => 'col-4'],
        'image_tag' => ['caption' => 'Подпись на фото', 'type' => 'text', 'layout' => 'col-4'],
    ],
];
