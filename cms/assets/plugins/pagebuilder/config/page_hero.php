<?php

return [
    'title'     => 'Первый экран (внутренняя)',
    'container' => 'default',
    'order'     => 1,
    'fields'    => [
        'image'     => ['caption' => 'Фоновое изображение', 'type' => 'image'],
        'eyebrow'   => ['caption' => 'Надзаголовок', 'type' => 'text', 'layout' => 'col-6'],
        'heading'   => ['caption' => 'Заголовок H1', 'type' => 'text', 'layout' => 'col-6'],
        'lead'      => ['caption' => 'Подводка', 'type' => 'textarea'],
        'btn1_text' => ['caption' => 'Кнопка 1 — текст', 'type' => 'text', 'layout' => 'col-3'],
        'btn1_link' => ['caption' => 'Кнопка 1 — ссылка', 'type' => 'text', 'layout' => 'col-3', 'note' => 'Пусто = #zayavka'],
        'btn2_text' => ['caption' => 'Кнопка 2 — текст', 'type' => 'text', 'layout' => 'col-3'],
        'btn2_link' => ['caption' => 'Кнопка 2 — ссылка', 'type' => 'text', 'layout' => 'col-3', 'note' => 'Пусто = WhatsApp из настроек'],
    ],
];
