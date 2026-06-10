<?php

return [
    'title'     => 'Сетка направлений',
    'container' => 'default',
    'order'     => 13,
    'fields'    => [
        'eyebrow' => ['caption' => 'Надзаголовок', 'type' => 'text', 'layout' => 'col-4'],
        'heading' => ['caption' => 'Заголовок', 'type' => 'text', 'layout' => 'col-8'],
        'text'    => ['caption' => 'Подзаголовок', 'type' => 'textarea'],
        'cards'   => ['caption' => 'Карточки', 'type' => 'group', 'fields' => [
            'doc_id'    => ['caption' => 'ID ресурса (ссылка)', 'type' => 'text', 'layout' => 'col-3'],
            'anchor'    => ['caption' => 'Якорь (#...)', 'type' => 'text', 'layout' => 'col-3'],
            'num'       => ['caption' => 'Номер/метка', 'type' => 'text', 'layout' => 'col-6'],
            'image'     => ['caption' => 'Фото', 'type' => 'image', 'layout' => 'col-6'],
            'image_alt' => ['caption' => 'Alt фото', 'type' => 'text', 'layout' => 'col-6'],
            'title'     => ['caption' => 'Заголовок', 'type' => 'text', 'layout' => 'col-6'],
            'tags'      => ['caption' => 'Теги через запятую', 'type' => 'text', 'layout' => 'col-6'],
            'text'      => ['caption' => 'Текст', 'type' => 'textarea'],
        ]],
    ],
];
