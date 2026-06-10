<?php

return [
    'title'     => 'Вопросы и ответы',
    'container' => 'default',
    'order'     => 6,
    'fields'    => [
        'anchor'  => ['caption' => 'Якорь (id секции)', 'type' => 'text', 'layout' => 'col-4', 'default' => 'faq'],
        'eyebrow' => ['caption' => 'Надзаголовок', 'type' => 'text', 'layout' => 'col-4', 'default' => 'Вопросы и ответы'],
        'heading' => ['caption' => 'Заголовок', 'type' => 'text', 'layout' => 'col-4', 'default' => 'Частые вопросы'],
        'items'   => ['caption' => 'Вопросы', 'type' => 'group', 'fields' => [
            'question' => ['caption' => 'Вопрос', 'type' => 'text'],
            'answer'   => ['caption' => 'Ответ', 'type' => 'textarea'],
        ]],
    ],
];
