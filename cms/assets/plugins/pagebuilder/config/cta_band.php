<?php

return [
    'title'     => 'CTA-плашка с кнопками',
    'container' => 'default',
    'order'     => 7,
    'fields'    => [
        'eyebrow' => ['caption' => 'Надзаголовок', 'type' => 'text', 'layout' => 'col-6'],
        'heading' => ['caption' => 'Заголовок', 'type' => 'text', 'layout' => 'col-6'],
        'text'    => ['caption' => 'Текст', 'type' => 'textarea'],
        'buttons' => ['caption' => 'Кнопки', 'type' => 'group', 'fields' => [
            'text'  => ['caption' => 'Текст', 'type' => 'text', 'layout' => 'col-5'],
            'link'  => ['caption' => 'Ссылка', 'type' => 'text', 'layout' => 'col-5'],
            'style' => ['caption' => 'Стиль', 'type' => 'dropdown', 'layout' => 'col-2', 'elements' => ['ghost' => 'Контурная', 'primary' => 'Основная'], 'default' => 'ghost'],
        ]],
    ],
];
