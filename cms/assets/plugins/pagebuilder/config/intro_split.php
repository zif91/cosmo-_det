<?php

return [
    'title'     => 'Текст + фото + чек-лист',
    'container' => 'default',
    'order'     => 2,
    'fields'    => [
        'tag'       => ['caption' => 'Надзаголовок', 'type' => 'text', 'layout' => 'col-6'],
        'heading'   => ['caption' => 'Заголовок', 'type' => 'text', 'layout' => 'col-6'],
        'text'      => ['caption' => 'Текст', 'type' => 'textarea'],
        'checks'    => ['caption' => 'Чек-лист', 'type' => 'group', 'fields' => [
            'text' => ['caption' => 'Пункт (можно <b>жирный</b>)', 'type' => 'text'],
        ]],
        'image'     => ['caption' => 'Фото', 'type' => 'image', 'layout' => 'col-6'],
        'image_tag' => ['caption' => 'Подпись на фото', 'type' => 'text', 'layout' => 'col-6'],
    ],
];
