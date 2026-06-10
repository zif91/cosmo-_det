<?php

return [
    'title'     => 'Онлайн-запись',
    'container' => 'default',
    'order'     => 21,
    'fields'    => [
        'eyebrow'  => ['caption' => 'Надзаголовок', 'type' => 'text', 'layout' => 'col-4', 'default' => 'Онлайн-запись'],
        'heading'  => ['caption' => 'Заголовок', 'type' => 'text', 'layout' => 'col-8'],
        'text'     => ['caption' => 'Подзаголовок', 'type' => 'textarea'],
        'btn_text' => ['caption' => 'Текст кнопки', 'type' => 'text', 'default' => 'Записаться'],
    ],
];
