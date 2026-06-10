<?php

return [
    'title'     => 'Первый экран (главная)',
    'container' => 'default',
    'order'     => 10,
    'fields'    => [
        'image'     => ['caption' => 'Фоновое изображение', 'type' => 'image', 'layout' => 'col-8'],
        'image_alt' => ['caption' => 'Alt изображения', 'type' => 'text', 'layout' => 'col-4'],
        'eyebrow'   => ['caption' => 'Надзаголовок', 'type' => 'text'],
        'heading'   => ['caption' => 'Заголовок H1 (HTML)', 'type' => 'textarea', 'note' => 'Можно <br> и <span class="shine">'],
        'lead'      => ['caption' => 'Подводка (HTML)', 'type' => 'textarea'],
        'btn1_text' => ['caption' => 'Кнопка 1 — текст', 'type' => 'text', 'layout' => 'col-3'],
        'btn1_link' => ['caption' => 'Кнопка 1 — ссылка', 'type' => 'text', 'layout' => 'col-3'],
        'btn2_text' => ['caption' => 'Кнопка 2 — текст (WhatsApp)', 'type' => 'text', 'layout' => 'col-3'],
        'btn2_link' => ['caption' => 'Кнопка 2 — ссылка', 'type' => 'text', 'layout' => 'col-3', 'note' => 'Пусто = WhatsApp из настроек'],
        'counters'  => ['caption' => 'Счётчики', 'type' => 'group', 'fields' => [
            'value'  => ['caption' => 'Число/значение', 'type' => 'text', 'layout' => 'col-4'],
            'suffix' => ['caption' => 'Суффикс (+, %)', 'type' => 'text', 'layout' => 'col-3'],
            'label'  => ['caption' => 'Подпись', 'type' => 'text', 'layout' => 'col-5'],
        ]],
    ],
];
